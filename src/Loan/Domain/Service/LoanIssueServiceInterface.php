<?php

declare(strict_types=1);


namespace App\Loan\Domain\Service;

use App\Loan\Domain\Entity\Loan;
use App\Loan\Domain\Entity\LoanApprovedRequest;

interface LoanIssueServiceInterface
{
    public function issueForApprovedRequest(LoanApprovedRequest $approvedRequest): Loan;
}