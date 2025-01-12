<?php

declare(strict_types=1);

namespace App\Loan\Domain\Exception;

use App\Loan\Domain\Entity\Loan\LoanId;
use App\Shared\Domain\Exception\DomainException;

final class LoanNotFoundException extends DomainException
{
    public function __construct(LoanId $id)
    {
        parent::__construct(
            sprintf('A loan with id "%s" not found.', $id->value())
        );
    }
}