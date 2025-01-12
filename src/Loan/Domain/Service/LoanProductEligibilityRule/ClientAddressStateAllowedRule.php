<?php

declare(strict_types=1);

namespace App\Loan\Domain\Service\LoanProductEligibilityRule;

use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressState;

final readonly class ClientAddressStateAllowedRule implements LoanProductEligibilityRuleInterface
{

    public function __construct(
        private ClientAddressState $clientAddressState,
    )
    {
    }

    public function isValid(): bool
    {
        return $this->clientAddressState->isInList($this->getAllowedStates());
    }

    public function failedMessage(): string
    {
        return sprintf('Client address state must be is one from the list: %s.', implode(', ', $this->getAllowedStates()));
    }

    /**
     * @return ClientAddressState[]
     */
    private function getAllowedStates(): array
    {
        return [
            ClientAddressState::fromString('CA'),
            ClientAddressState::fromString('NY'),
            ClientAddressState::fromString('NV'),
        ];
    }
}