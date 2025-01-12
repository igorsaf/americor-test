<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Orm\Types\ClientAddress;

use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectStringAsVarcharType;
use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressCity;

final class ClientAddressCityType extends AbstractValueObjectStringAsVarcharType
{

    public function getConcreteValueObjectType(): string
    {
        return ClientAddressCity::class;
    }

    public function getName(): string
    {
        return 'client_address_city';
    }
}