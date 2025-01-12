<?php

declare(strict_types=1);

namespace App\Shared\Application\Http;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

final class ApiResponse extends JsonResponse
{
    private const array SERIALIZER_CONTEXT = ['skip_null_values' => true];

    public function __construct(
        null|object|array $data,
        int $status = self::HTTP_OK,
        array $headers = [],
        bool $json = false,
        private readonly SerializerInterface $serializer,
    ) {
        $normalizedData = $this->serializer->normalize($data, null, self::SERIALIZER_CONTEXT);

        parent::__construct($normalizedData, $status, $headers, $json);
    }
}