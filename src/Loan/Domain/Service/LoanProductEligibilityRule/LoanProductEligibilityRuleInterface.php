<?php

declare(strict_types=1);


namespace App\Loan\Domain\Service\LoanProductEligibilityRule;

interface LoanProductEligibilityRuleInterface
{
    public function isValid(): bool;

    public function failedMessage(): string;
}