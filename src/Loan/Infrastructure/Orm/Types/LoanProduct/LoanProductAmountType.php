<?php

declare(strict_types=1);

namespace App\Loan\Infrastructure\Orm\Types\LoanProduct;

use App\Loan\Domain\Entity\LoanProduct\LoanProductAmount;
use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectMoneyAsBigIntType;

final class LoanProductAmountType extends AbstractValueObjectMoneyAsBigIntType
{

    public function getConcreteValueObjectType(): string
    {
        return LoanProductAmount::class;
    }

    public function getName(): string
    {
        return 'loan_product_amount';
    }
}