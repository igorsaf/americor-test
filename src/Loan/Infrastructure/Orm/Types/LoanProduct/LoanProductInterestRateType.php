<?php

declare(strict_types=1);

namespace App\Loan\Infrastructure\Orm\Types\LoanProduct;

use App\Loan\Domain\Entity\LoanProduct\LoanProductInterestRate;
use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectPercentAsIntType;

final class LoanProductInterestRateType extends AbstractValueObjectPercentAsIntType
{

    public function getConcreteValueObjectType(): string
    {
        return LoanProductInterestRate::class;
    }

    public function getName(): string
    {
        return 'loan_product_interest_rate';
    }
}