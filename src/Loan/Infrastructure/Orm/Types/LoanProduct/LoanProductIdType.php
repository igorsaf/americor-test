<?php

declare(strict_types=1);

namespace App\Loan\Infrastructure\Orm\Types\LoanProduct;

use App\Loan\Domain\Entity\LoanProduct\LoanProductId;
use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectUuidAsUuidType;

final class LoanProductIdType extends AbstractValueObjectUuidAsUuidType
{

    public function getConcreteValueObjectType(): string
    {
        return LoanProductId::class;
    }

    public function getName(): string
    {
        return 'loan_product_id';
    }
}