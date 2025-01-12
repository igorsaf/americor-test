<?php

declare(strict_types=1);

namespace App\Loan\Domain\Exception;

use App\Shared\Domain\Exception\DomainException;

final class LoanProductNotEligibleException extends DomainException
{
    public function __construct(string $reason)
    {
        parent::__construct($reason);
    }
}