<?php

declare(strict_types=1);

namespace App\Loan\Application\Command\LoanIssue;

use App\Client\Application\Validation\ClientIdRequirements;

final readonly class LoanIssueCommand
{

    public function __construct(
        #[ClientIdRequirements]
        public string $loanApprovedRequestId,
    )
    {
    }
}