<?php

declare(strict_types=1);

namespace App\Loan\Application\Command\LoanPreIssueCheck;

final readonly class LoanPreIssueCheckResult
{

    public function __construct(
        public bool $isEligible,
        public ?string $nonEligibleReason = null,
        public ?LoanPreConditions $loanPreConditions = null
    )
    {
    }
}