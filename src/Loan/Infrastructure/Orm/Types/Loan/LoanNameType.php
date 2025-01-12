<?php

declare(strict_types=1);

namespace App\Loan\Infrastructure\Orm\Types\Loan;

use App\Loan\Domain\Entity\Loan\LoanName;
use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectStringAsVarcharType;

final class LoanNameType extends AbstractValueObjectStringAsVarcharType
{

    public function getConcreteValueObjectType(): string
    {
        return LoanName::class;
    }

    public function getName(): string
    {
        return 'loan_name';
    }
}