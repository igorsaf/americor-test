<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Orm\Types\Client;

use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectUuidAsUuidType;
use App\Client\Domain\Entity\Client\ClientId;

final class ClientIdType extends AbstractValueObjectUuidAsUuidType
{

    public function getConcreteValueObjectType(): string
    {
        return ClientId::class;
    }

    public function getName(): string
    {
        return 'client_id';
    }
}