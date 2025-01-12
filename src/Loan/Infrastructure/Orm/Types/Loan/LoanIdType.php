<?php

declare(strict_types=1);

namespace App\Loan\Infrastructure\Orm\Types\Loan;

use App\Loan\Domain\Entity\Loan\LoanId;
use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectUuidAsUuidType;

final class LoanIdType extends AbstractValueObjectUuidAsUuidType
{

    public function getConcreteValueObjectType(): string
    {
        return LoanId::class;
    }

    public function getName(): string
    {
        return 'loan_id';
    }
}