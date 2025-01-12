<?php

declare(strict_types=1);

namespace App\Loan\Application\Controller\Api\V1\PostLoanPreIssueCheck;

use App\Loan\Application\Command\LoanPreIssueCheck\LoanPreIssueCheckCommand;
use App\Loan\Application\Command\LoanPreIssueCheck\LoanPreIssueCheckResult;
use App\Shared\Application\Http\ApiResponse;
use App\Shared\Application\Http\ApiResponseFactory;
use App\Shared\Application\Validation\ValidationService;
use App\Shared\Infrastructure\Messenger\MessengerHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final readonly class PostLoanPreIssueCheckApiController
{
    public function __construct(
        private MessageBusInterface $commandBus,
        private ValidationService $validationService,
        private ApiResponseFactory $apiResponseFactory
    )
    {
    }

    #[Route('/api/v1/loans/pre-issue-check', methods: ['POST'])]
    public function __invoke(Request $request): ApiResponse
    {
        $requestData = json_decode($request->getContent(), true) ?? [];

        $command = new LoanPreIssueCheckCommand(
            (string)($requestData['clientId'] ?? ''),
            (int)($requestData['clientMonthlyIncome'] ?? ''),
            (string)($requestData['loanProductId'] ?? '')
        );

        $this->validationService->validate($command);

        $loanPreIssueCheckResult = $this->loanPreIssueCheck($command);

        return $this->apiResponseFactory->make(
            PostLoanPreIssueCheckResponse::fromLoanPreIssueCheckResult($loanPreIssueCheckResult)
        );
    }

    private function loanPreIssueCheck(LoanPreIssueCheckCommand $command): LoanPreIssueCheckResult
    {
        $envelope = $this->commandBus->dispatch($command);

        return MessengerHelper::extractResultFromEnvelope($envelope);
    }
}