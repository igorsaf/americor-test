<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Orm\Types\ClientAddress;

use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectStringAsVarcharType;
use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressZip;

final class ClientAddressZipType extends AbstractValueObjectStringAsVarcharType
{

    private const int LENGTH = 10;

    public function getConcreteValueObjectType(): string
    {
        return ClientAddressZip::class;
    }

    public function getName(): string
    {
        return 'client_address_zip';
    }

    public function getColumnLength(): int
    {
        return self::LENGTH;
    }
}