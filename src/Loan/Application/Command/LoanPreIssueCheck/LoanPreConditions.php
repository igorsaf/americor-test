<?php

declare(strict_types=1);

namespace App\Loan\Application\Command\LoanPreIssueCheck;

use App\Loan\Domain\Entity\LoanApprovedRequest;

final readonly class LoanPreConditions
{
    public function __construct(
        public string $acceptedRequestId,
        public string $name,
        public int $term,
        public float $interestRate,
        public float $amount
    )
    {
    }

    public static function fromLoanApprovedRequest(LoanApprovedRequest $loanApprovedRequest): self
    {
        return new self(
            $loanApprovedRequest->id->value(),
            $loanApprovedRequest->loanProductName->value(),
            $loanApprovedRequest->loanProductTerm->value(),
            $loanApprovedRequest->loanProductInterestRate->toPercentage(),
            $loanApprovedRequest->loanProductAmount->toAmount()
        );
    }
}