<?php

declare(strict_types=1);

namespace App\Client\Application\Controller\Api\V1\PostCreateClient;

use App\Client\Domain\Entity\Client\ClientId;

final readonly class PostCreateClientApiResponse
{
    public function __construct(
        public string $clientId
    )
    {
    }

    public static function fromClientId(ClientId $clientId): self
    {
        return new self($clientId->value());
    }
}