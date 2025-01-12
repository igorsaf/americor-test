<?php

declare(strict_types=1);

namespace App\Loan\Domain\Event;

use App\Loan\Domain\Entity\Loan\LoanId;

final readonly class LoanIssuedEvent
{

    public function __construct(
        public LoanId $loanId
    )
    {
    }
}