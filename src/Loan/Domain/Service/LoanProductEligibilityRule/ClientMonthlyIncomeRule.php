<?php

declare(strict_types=1);

namespace App\Loan\Domain\Service\LoanProductEligibilityRule;

use App\Loan\Domain\Entity\ClientMonthlyIncome;

final readonly class ClientMonthlyIncomeRule implements LoanProductEligibilityRuleInterface
{
    private const float MINIMAL_MONTHLY_INCOME_IN_CENTS = 1000.00;

    public function __construct(
        private ClientMonthlyIncome $clientMonthlyIncome
    )
    {
    }

    public function isValid(): bool
    {
        return $this->clientMonthlyIncome->isBiggerThan(ClientMonthlyIncome::fromAmount(self::MINIMAL_MONTHLY_INCOME_IN_CENTS));
    }

    public function failedMessage(): string
    {
        return sprintf('Client monthly income must be greater than %s.', self::MINIMAL_MONTHLY_INCOME_IN_CENTS);
    }
}