<?php

declare(strict_types=1);

namespace App\Shared\Application\Http;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

final readonly class ApiResponseFactory
{
    public function __construct(
        private SerializerInterface $serializer
    ) {}

    public function make(
        null|object|array $data,
        int $status = Response::HTTP_OK
    ): ApiResponse {
        return new ApiResponse($data, $status, [], false, $this->serializer);
    }
}