<?php

declare(strict_types=1);

namespace App\Loan\Infrastructure\Orm\Types\LoanProduct;

use App\Loan\Domain\Entity\LoanProduct\LoanProductTerm;
use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectIntAsIntType;

final class LoanProductTermType extends AbstractValueObjectIntAsIntType
{

    public function getConcreteValueObjectType(): string
    {
        return LoanProductTerm::class;
    }

    public function getName(): string
    {
        return 'loan_product_term';
    }
}