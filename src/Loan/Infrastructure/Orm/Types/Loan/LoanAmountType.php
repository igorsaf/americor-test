<?php

declare(strict_types=1);

namespace App\Loan\Infrastructure\Orm\Types\Loan;

use App\Loan\Domain\Entity\Loan\LoanAmount;
use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectMoneyAsBigIntType;

final class LoanAmountType extends AbstractValueObjectMoneyAsBigIntType
{

    public function getConcreteValueObjectType(): string
    {
        return LoanAmount::class;
    }

    public function getName(): string
    {
        return 'loan_amount';
    }
}