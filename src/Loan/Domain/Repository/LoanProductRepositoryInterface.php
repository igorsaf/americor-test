<?php

declare(strict_types=1);


namespace App\Loan\Domain\Repository;

use App\Loan\Domain\Entity\LoanProduct;
use App\Loan\Domain\Entity\LoanProduct\LoanProductId;

interface LoanProductRepositoryInterface
{
    public function save(LoanProduct $loanProduct): void;

    public function findById(LoanProductId $id): ?LoanProduct;
}