<?php

declare(strict_types=1);

namespace App\Loan\Application\Command\LoanPreIssueCheck;

use App\Client\Domain\Entity\Client\ClientId;
use App\Client\Domain\Exception\ClientNotFoundException;
use App\Client\Domain\Repository\ClientRepositoryInterface;
use App\Loan\Domain\Entity\ClientMonthlyIncome;
use App\Loan\Domain\Entity\LoanApprovedRequest;
use App\Loan\Domain\Entity\LoanApprovedRequest\LoanApprovedRequestId;
use App\Loan\Domain\Entity\LoanProduct\LoanProductId;
use App\Loan\Domain\Exception\LoanProductNotEligibleException;
use App\Loan\Domain\Exception\LoanProductNotFoundException;
use App\Loan\Domain\Repository\LoanApprovedRequestRepositoryInterface;
use App\Loan\Domain\Repository\LoanProductRepositoryInterface;
use App\Loan\Domain\Service\LoanApprovedRequestInterestRateCalculator;
use App\Loan\Domain\Service\LoanProductEligibilityService;
use App\Shared\Domain\Exception\DomainException;
use DateTimeImmutable;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class LoanPreIssueCheckCommandHandler
{

    public function __construct(
        private ClientRepositoryInterface $clientRepository,
        private LoanProductRepositoryInterface $loanProductRepository,
        private LoanProductEligibilityService $loanProductEligibilityService,
        private LoanApprovedRequestInterestRateCalculator $interestRateCalculator,
        private LoanApprovedRequestRepositoryInterface $loanApprovedRequestRepository
    )
    {
    }

    /**
     * @throws DomainException
     * @throws LoanProductNotEligibleException
     */
    public function __invoke(LoanPreIssueCheckCommand $query): LoanPreIssueCheckResult
    {
        $clientMonthlyIncome = ClientMonthlyIncome::fromAmount($query->clientMonthlyIncome);

        $clientId = ClientId::fromString($query->clientId);
        $client = $this->clientRepository->findById($clientId);
        if ($client === null) {
            throw new ClientNotFoundException($clientId);
        }

        $loanProductId = LoanProductId::fromString($query->loanProductId);
        $loanProduct = $this->loanProductRepository->findById($loanProductId);
        if ($loanProduct === null) {
            throw new LoanProductNotFoundException($clientId);
        }

        try {
            $this->loanProductEligibilityService->eligibleOrThrow(
                $client,
                $clientMonthlyIncome,
                new DateTimeImmutable()
            );
        } catch (LoanProductNotEligibleException $exception) {
            return new LoanPreIssueCheckResult(
                isEligible: false,
                nonEligibleReason: $exception->getMessage()
            );
        }


        $loanApprovedRequest = new LoanApprovedRequest(
            LoanApprovedRequestId::next(),
            $client->getId(),
            $loanProduct->id,
            $loanProduct->name,
            $loanProduct->term,
            $this->interestRateCalculator->calculateForClientAndLoanProduct($client, $loanProduct),
            $loanProduct->amount,
            new DateTimeImmutable()
        );

        $this->loanApprovedRequestRepository->save($loanApprovedRequest);

        return new LoanPreIssueCheckResult(
            isEligible: true,
            loanPreConditions: LoanPreConditions::fromLoanApprovedRequest($loanApprovedRequest)
        );
    }
}