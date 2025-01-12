<?php

declare(strict_types=1);

namespace App\Loan\Infrastructure\Orm\Types\Loan;

use App\Loan\Domain\Entity\Loan\LoanInterestRate;
use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectPercentAsIntType;

final class LoanInterestRateType extends AbstractValueObjectPercentAsIntType
{

    public function getConcreteValueObjectType(): string
    {
        return LoanInterestRate::class;
    }

    public function getName(): string
    {
        return 'loan_interest_rate';
    }
}