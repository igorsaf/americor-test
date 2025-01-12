<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Orm\Types\Client;

use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectStringAsVarcharType;
use App\Client\Domain\Entity\Client\ClientLastName;

final class ClientLastNameType extends AbstractValueObjectStringAsVarcharType
{

    public function getConcreteValueObjectType(): string
    {
        return ClientLastName::class;
    }

    public function getName(): string
    {
        return 'client_last_name';
    }
}