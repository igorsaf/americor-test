<?php

declare(strict_types=1);

namespace App\Client\Application\Controller\Api\V1\PutUpdateClient;

use App\Client\Application\Command\UpdateClient\UpdateClientCommand;
use App\Shared\Application\Http\ApiResponse;
use App\Shared\Application\Http\ApiResponseFactory;
use App\Shared\Application\Validation\ValidationService;
use App\Shared\Infrastructure\MessengerHelper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final readonly class PutUpdateClientApiController
{
    public function __construct(
        private MessageBusInterface $commandBus,
        private ValidationService $validationService,
        private ApiResponseFactory $apiResponseFactory
    )
    {
    }

    #[Route('/api/v1/clients/{clientId}', methods: ['PUT'])]
    public function __invoke(Request $request, string $clientId): ApiResponse
    {
        $requestData = json_decode($request->getContent(), true) ?? [];

        $command = new UpdateClientCommand(
            $clientId,
            (string)($requestData['lastName'] ?? ''),
            (string)($requestData['firstName'] ?? ''),
            (string)($requestData['birthDate'] ?? ''),
            (string)($requestData['ssn'] ?? ''),
            (int)($requestData['ficoRating'] ?? ''),
            (string)($requestData['email'] ?? ''),
            (string)($requestData['phone'] ?? ''),
            (string)($requestData['addressStreet'] ?? ''),
            (string)($requestData['addressCity'] ?? ''),
            (string)($requestData['addressState'] ?? ''),
            (string)($requestData['addressZip'] ?? '')
        );

        $this->validationService->validate($command);

        $this->commandBus->dispatch($command);

        return $this->apiResponseFactory->make(null, Response::HTTP_ACCEPTED);
    }
}