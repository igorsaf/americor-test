<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Orm\Types\Client;

use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectStringAsVarcharType;
use App\Client\Domain\Entity\Client\ClientPhone;

final class ClientPhoneType extends AbstractValueObjectStringAsVarcharType
{

    private const int LENGTH = 17;

    public function getConcreteValueObjectType(): string
    {
        return ClientPhone::class;
    }

    public function getName(): string
    {
        return 'client_phone';
    }

    public function getColumnLength(): int
    {
        return self::LENGTH;
    }
}