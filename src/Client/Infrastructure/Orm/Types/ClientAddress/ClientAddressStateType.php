<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Orm\Types\ClientAddress;

use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectStringAsVarcharType;
use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressState;

final class ClientAddressStateType extends AbstractValueObjectStringAsVarcharType
{

    private const int LENGTH = 2;

    public function getConcreteValueObjectType(): string
    {
        return ClientAddressState::class;
    }

    public function getName(): string
    {
        return 'client_address_state';
    }

    public function getColumnLength(): int
    {
        return self::LENGTH;
    }
}