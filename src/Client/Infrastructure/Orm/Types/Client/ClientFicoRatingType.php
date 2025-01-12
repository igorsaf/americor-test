<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Orm\Types\Client;

use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectIntAsSmallIntType;
use App\Client\Domain\Entity\Client\ClientFicoRating;

final class ClientFicoRatingType extends AbstractValueObjectIntAsSmallIntType
{

    public function getConcreteValueObjectType(): string
    {
        return ClientFicoRating::class;
    }

    public function getName(): string
    {
        return 'client_fico_rating';
    }
}