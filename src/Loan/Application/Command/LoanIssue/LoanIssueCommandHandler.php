<?php

declare(strict_types=1);

namespace App\Loan\Application\Command\LoanIssue;

use App\Loan\Domain\Entity\LoanApprovedRequest\LoanApprovedRequestId;
use App\Loan\Domain\Exception\LoanApprovedRequestNotFoundException;
use App\Loan\Domain\Repository\LoanApprovedRequestRepositoryInterface;
use App\Loan\Domain\Service\LoanIssueServiceInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class LoanIssueCommandHandler
{
    public function __construct(
        private LoanApprovedRequestRepositoryInterface $loanApprovedRequestRepository,
        private LoanIssueServiceInterface $loanIssueService,
    )
    {
    }

    /**
     * @throws LoanApprovedRequestNotFoundException
     */
    public function __invoke(LoanIssueCommand $command): void
    {
        $loanApprovedRequestId = LoanApprovedRequestId::fromString($command->loanApprovedRequestId);
        $loanApprovedRequest = $this->loanApprovedRequestRepository->findById($loanApprovedRequestId);
        if ($loanApprovedRequest === null) {
            throw new LoanApprovedRequestNotFoundException($loanApprovedRequestId);
        }

        $this->loanIssueService->issueForApprovedRequest($loanApprovedRequest);
    }
}