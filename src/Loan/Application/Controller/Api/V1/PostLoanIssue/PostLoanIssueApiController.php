<?php

declare(strict_types=1);

namespace App\Loan\Application\Controller\Api\V1\PostLoanIssue;

use App\Loan\Application\Command\LoanIssue\LoanIssueCommand;
use App\Shared\Application\Http\ApiResponse;
use App\Shared\Application\Http\ApiResponseFactory;
use App\Shared\Application\Validation\ValidationService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final readonly class PostLoanIssueApiController
{
    public function __construct(
        private MessageBusInterface $commandBus,
        private ValidationService $validationService,
        private ApiResponseFactory $apiResponseFactory
    )
    {
    }

    #[Route('/api/v1/loans/issue', methods: ['POST'])]
    public function __invoke(Request $request): ApiResponse
    {
        $requestData = json_decode($request->getContent(), true) ?? [];

        $command = new LoanIssueCommand((string)($requestData['approvedRequestId'] ?? ''));

        $this->validationService->validate($command);

        $this->commandBus->dispatch($command);

        return $this->apiResponseFactory->make(null, Response::HTTP_ACCEPTED);
    }
}