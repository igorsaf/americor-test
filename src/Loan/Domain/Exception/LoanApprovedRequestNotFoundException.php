<?php

declare(strict_types=1);

namespace App\Loan\Domain\Exception;

use App\Loan\Domain\Entity\LoanApprovedRequest\LoanApprovedRequestId;
use App\Shared\Domain\Exception\DomainException;

final class LoanApprovedRequestNotFoundException extends DomainException
{

    public function __construct(LoanApprovedRequestId $id)
    {
        parent::__construct(
            sprintf('A loan product approved request with id "%s" not found.', $id->value())
        );
    }
}