<?php

declare(strict_types=1);

namespace App\Loan\Domain\Entity;

use App\Loan\Domain\Entity\LoanProduct\LoanProductAmount;
use App\Loan\Domain\Entity\LoanProduct\LoanProductId;
use App\Loan\Domain\Entity\LoanProduct\LoanProductInterestRate;
use App\Loan\Domain\Entity\LoanProduct\LoanProductName;
use App\Loan\Domain\Entity\LoanProduct\LoanProductTerm;
use DateTimeImmutable;

final readonly class LoanProduct
{

    public function __construct(
        public LoanProductId $id,
        public LoanProductName $name,
        public LoanProductTerm $term,
        public LoanProductInterestRate $interestRate,
        public LoanProductAmount $amount,
        public DateTimeImmutable $createdAt
    )
    {
    }

}