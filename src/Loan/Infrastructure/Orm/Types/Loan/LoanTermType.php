<?php

declare(strict_types=1);

namespace App\Loan\Infrastructure\Orm\Types\Loan;

use App\Loan\Domain\Entity\Loan\LoanTerm;
use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectIntAsIntType;

final class LoanTermType extends AbstractValueObjectIntAsIntType
{

    public function getConcreteValueObjectType(): string
    {
        return LoanTerm::class;
    }

    public function getName(): string
    {
        return 'loan_term';
    }
}