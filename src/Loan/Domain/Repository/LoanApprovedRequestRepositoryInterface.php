<?php

declare(strict_types=1);


namespace App\Loan\Domain\Repository;

use App\Loan\Domain\Entity\LoanApprovedRequest;
use App\Loan\Domain\Entity\LoanApprovedRequest\LoanApprovedRequestId;

interface LoanApprovedRequestRepositoryInterface
{
    public function save(LoanApprovedRequest $loanApprovedRequest): void;

    public function findById(LoanApprovedRequestId $id): ?LoanApprovedRequest;
}