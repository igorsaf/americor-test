<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Orm\Types\Client;

use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectStringAsVarcharType;
use App\Client\Domain\Entity\Client\ClientFirstName;

final class ClientFirstNameType extends AbstractValueObjectStringAsVarcharType
{

    public function getConcreteValueObjectType(): string
    {
        return ClientFirstName::class;
    }

    public function getName(): string
    {
        return 'client_first_name';
    }
}