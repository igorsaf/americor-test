<?php

declare(strict_types=1);


namespace App\Loan\Domain\Repository;

use App\Loan\Domain\Entity\Loan;
use App\Loan\Domain\Entity\Loan\LoanId;
use App\Loan\Domain\Entity\LoanApprovedRequest\LoanApprovedRequestId;

interface LoanRepositoryInterface
{
    public function save(Loan $loan): void;

    public function findById(LoanId $id): ?Loan;

    public function findByApprovedRequestId(LoanApprovedRequestId $id): ?Loan;
}