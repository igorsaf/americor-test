<?php

declare(strict_types=1);

namespace App\Loan\Application\Command\LoanPreIssueCheck;

use App\Client\Application\Validation\ClientIdRequirements;
use App\Loan\Application\Validation\ClientMonthlyIncomeRequirements;
use App\Loan\Application\Validation\LoanProductIdRequirements;

final readonly class LoanPreIssueCheckCommand
{

    public function __construct(
        #[ClientIdRequirements]
        public string $clientId,
        #[ClientMonthlyIncomeRequirements]
        public int $clientMonthlyIncome,
        #[LoanProductIdRequirements]
        public string $loanProductId,
    )
    {
    }
}