<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Orm\Types\Client;

use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectStringAsVarcharType;
use App\Client\Domain\Entity\Client\ClientSsn;

final class ClientSsnType extends AbstractValueObjectStringAsVarcharType
{

    private const int LENGTH = 11;

    public function getConcreteValueObjectType(): string
    {
        return ClientSsn::class;
    }

    public function getName(): string
    {
        return 'client_ssn';
    }

    public function getColumnLength(): int
    {
        return self::LENGTH;
    }
}