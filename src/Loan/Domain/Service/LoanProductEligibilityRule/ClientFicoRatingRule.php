<?php

declare(strict_types=1);

namespace App\Loan\Domain\Service\LoanProductEligibilityRule;

use App\Client\Domain\Entity\Client\ClientFicoRating;

final readonly class ClientFicoRatingRule implements LoanProductEligibilityRuleInterface
{
    private const int MINIMAL_RATING = 500;

    public function __construct(
        private ClientFicoRating $clientFicoRating
    )
    {
    }

    public function isValid(): bool
    {
        return $this->clientFicoRating->isBiggerThan(ClientFicoRating::fromInt(self::MINIMAL_RATING));
    }

    public function failedMessage(): string
    {
        return sprintf('Client FICO rating must be greater than %d.', self::MINIMAL_RATING);
    }
}