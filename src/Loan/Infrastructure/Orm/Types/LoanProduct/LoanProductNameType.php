<?php

declare(strict_types=1);

namespace App\Loan\Infrastructure\Orm\Types\LoanProduct;

use App\Loan\Domain\Entity\LoanProduct\LoanProductName;
use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectStringAsVarcharType;

final class LoanProductNameType extends AbstractValueObjectStringAsVarcharType
{

    public function getConcreteValueObjectType(): string
    {
        return LoanProductName::class;
    }

    public function getName(): string
    {
        return 'loan_product_name';
    }
}