<?php

declare(strict_types=1);

namespace App\Loan\Domain\Service\LoanProductEligibilityRule;

use DateTimeImmutable;

final readonly class ClientAgeRule implements LoanProductEligibilityRuleInterface
{
    private const int MIN_AGE_IN_YEARS = 18;
    private const int MAX_AGE_IN_YEARS = 60;

    public function __construct(
        private DateTimeImmutable $clientBirthDate,
        private DateTimeImmutable $validationDate
    )
    {
    }

    public function isValid(): bool
    {
        $clientAgeInYears = $this->getClientAgeInYears();

        return $clientAgeInYears >= self::MIN_AGE_IN_YEARS && $clientAgeInYears <= self::MAX_AGE_IN_YEARS;
    }

    public function failedMessage(): string
    {
        return sprintf('Client age must be between %d and %d.', self::MIN_AGE_IN_YEARS, self::MAX_AGE_IN_YEARS);
    }

    private function getClientAgeInYears(): int
    {
        return $this->clientBirthDate->diff($this->validationDate)->y;
    }
}