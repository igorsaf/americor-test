<?php

declare(strict_types=1);

namespace App\Loan\Domain\Exception;

use App\Loan\Domain\Entity\LoanApprovedRequest\LoanApprovedRequestId;
use App\Shared\Domain\Exception\DomainException;

final class LoanAlreadyIssuedException extends DomainException
{
    public static function forApprovedRequestId(LoanApprovedRequestId $id): self
    {
        return new self(
            sprintf('A loan for approved request with id "%s" already issued.', $id->value())
        );
    }
}