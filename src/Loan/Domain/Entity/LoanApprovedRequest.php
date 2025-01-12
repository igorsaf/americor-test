<?php

declare(strict_types=1);

namespace App\Loan\Domain\Entity;

use App\Client\Domain\Entity\Client\ClientId;
use App\Loan\Domain\Entity\LoanProduct\LoanProductAmount;
use App\Loan\Domain\Entity\LoanProduct\LoanProductId;
use App\Loan\Domain\Entity\LoanProduct\LoanProductInterestRate;
use App\Loan\Domain\Entity\LoanProduct\LoanProductName;
use App\Loan\Domain\Entity\LoanProduct\LoanProductTerm;
use App\Loan\Domain\Entity\LoanApprovedRequest\LoanApprovedRequestId;
use DateTimeImmutable;

final readonly class LoanApprovedRequest
{
    public function __construct(
        public LoanApprovedRequestId $id,
        public ClientId $clientId,
        public LoanProductId $loanProductId,
        public LoanProductName $loanProductName,
        public LoanProductTerm $loanProductTerm,
        public LoanProductInterestRate $loanProductInterestRate,
        public LoanProductAmount $loanProductAmount,
        public DateTimeImmutable $createdAt
    )
    {
    }
}