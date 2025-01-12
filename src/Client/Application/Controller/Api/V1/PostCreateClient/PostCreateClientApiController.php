<?php

declare(strict_types=1);

namespace App\Client\Application\Controller\Api\V1\PostCreateClient;

use App\Client\Application\Command\CreateClient\CreateClientCommand;
use App\Client\Domain\Entity\Client\ClientId;
use App\Shared\Application\Http\ApiResponse;
use App\Shared\Application\Http\ApiResponseFactory;
use App\Shared\Application\Validation\ValidationService;
use App\Shared\Infrastructure\Messenger\MessengerHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final readonly class PostCreateClientApiController
{
    public function __construct(
        private MessageBusInterface $commandBus,
        private ValidationService $validationService,
        private ApiResponseFactory $apiResponseFactory
    )
    {
    }

    #[Route('/api/v1/clients', methods: ['POST'])]
    public function __invoke(Request $request): ApiResponse
    {
        $requestData = json_decode($request->getContent(), true) ?? [];

        $command = new CreateClientCommand(
            (string)($requestData['lastName'] ?? ''),
            (string)($requestData['firstName'] ?? ''),
            (string)($requestData['birthDate'] ?? ''),
            (string)($requestData['ssn'] ?? ''),
            (int)($requestData['ficoRating'] ?? 0),
            (string)($requestData['email'] ?? ''),
            (string)($requestData['phone'] ?? ''),
            (string)($requestData['addressStreet'] ?? ''),
            (string)($requestData['addressCity'] ?? ''),
            (string)($requestData['addressState'] ?? ''),
            (string)($requestData['addressZip'] ?? '')
        );

        $this->validationService->validate($command);

        $newClientId = $this->createClient($command);

        return $this->apiResponseFactory->make(
            PostCreateClientApiResponse::fromClientId($newClientId),
            Response::HTTP_CREATED
        );
    }

    private function createClient(CreateClientCommand $command): ClientId
    {
        $envelope = $this->commandBus->dispatch($command);

        return MessengerHelper::extractResultFromEnvelope($envelope);
    }
}