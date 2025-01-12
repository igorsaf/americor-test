<?php

declare(strict_types=1);

namespace App\Loan\Domain\Exception;

use App\Shared\Domain\Exception\DomainException;
use App\Client\Domain\Entity\Client\ClientId;

final class LoanProductNotFoundException extends DomainException
{

    public function __construct(ClientId $id)
    {
        parent::__construct(
            sprintf('A loan product with id "%s" not found.', $id->value())
        );
    }
}