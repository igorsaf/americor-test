<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Orm\Types\ClientAddress;

use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectStringAsVarcharType;
use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressStreet;

final class ClientAddressStreetType extends AbstractValueObjectStringAsVarcharType
{

    public function getConcreteValueObjectType(): string
    {
        return ClientAddressStreet::class;
    }

    public function getName(): string
    {
        return 'client_address_street';
    }
}