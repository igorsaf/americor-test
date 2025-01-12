<?php

declare(strict_types=1);

namespace App\Loan\Application\Controller\Api\V1\PostLoanPreIssueCheck;

use App\Loan\Application\Command\LoanPreIssueCheck\LoanPreConditions;
use App\Loan\Application\Command\LoanPreIssueCheck\LoanPreIssueCheckResult;

final readonly class PostLoanPreIssueCheckResponse
{
    public function __construct(
        public bool $isEligible,
        public ?string $nonEligibleReason = null,
        public ?LoanPreConditions $loanPreConditions = null
    )
    {
    }

    public static function fromLoanPreIssueCheckResult(LoanPreIssueCheckResult $result): self
    {
        return new self(
            $result->isEligible,
            $result->nonEligibleReason,
            $result->loanPreConditions
        );
    }
}