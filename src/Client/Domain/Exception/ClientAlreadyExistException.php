<?php

declare(strict_types=1);

namespace App\Client\Domain\Exception;

use App\Shared\Domain\Exception\DomainException;

final class ClientAlreadyExistException extends DomainException
{
    public function __construct(string $alreadyExistField, string $alreadyExistFieldValue)
    {
        parent::__construct(sprintf('A client with %s "%s" already exists.', $alreadyExistField, $alreadyExistFieldValue));
    }
}