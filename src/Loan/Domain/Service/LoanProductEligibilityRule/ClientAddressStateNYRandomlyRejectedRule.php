<?php

declare(strict_types=1);

namespace App\Loan\Domain\Service\LoanProductEligibilityRule;

use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressState;
use App\Loan\Domain\Service\RandomRejectionServiceInterface;

final readonly class ClientAddressStateNYRandomlyRejectedRule implements LoanProductEligibilityRuleInterface
{
    private const float NY_REJECTION_PROBABILITY = 0.5;

    public function __construct(
        private ClientAddressState $clientAddressState,
        private RandomRejectionServiceInterface $randomRejectionService
    )
    {
    }

    public function isValid(): bool
    {
        if ($this->clientAddressState !== ClientAddressState::fromString('NY')) {
            return true;
        }

        return !$this->randomRejectionService->shouldReject(self::NY_REJECTION_PROBABILITY);
    }

    public function failedMessage(): string
    {
        return 'Client with NY state address was randomly rejected.';
    }
}