<?php

declare(strict_types=1);

namespace App\Loan\Domain\Service;

use App\Loan\Domain\Entity\Loan;
use App\Loan\Domain\Entity\LoanApprovedRequest;
use App\Loan\Domain\Exception\LoanAlreadyIssuedException;
use App\Loan\Domain\Repository\LoanRepositoryInterface;
use DateTimeImmutable;

final readonly class LoanIssueService implements LoanIssueServiceInterface
{
    public function __construct(
        private LoanRepositoryInterface $loanRepository,
    )
    {
    }

    public function issueForApprovedRequest(LoanApprovedRequest $approvedRequest): Loan
    {
        if ($this->loanRepository->findByApprovedRequestId($approvedRequest->id) !== null) {
            throw LoanAlreadyIssuedException::forApprovedRequestId($approvedRequest->id);
        }

        $loan = Loan::fromApprovedRequestAndTime(
            $approvedRequest,
            new DateTimeImmutable()
        );

        $this->loanRepository->save($loan);

        return $loan;
    }
}