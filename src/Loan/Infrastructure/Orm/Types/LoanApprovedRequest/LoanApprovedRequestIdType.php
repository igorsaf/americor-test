<?php

declare(strict_types=1);

namespace App\Loan\Infrastructure\Orm\Types\LoanApprovedRequest;

use App\Loan\Domain\Entity\LoanApprovedRequest\LoanApprovedRequestId;
use App\Shared\Infrastructure\Orm\Types\AbstractValueObjectUuidAsUuidType;

final class LoanApprovedRequestIdType extends AbstractValueObjectUuidAsUuidType
{

    public function getConcreteValueObjectType(): string
    {
        return LoanApprovedRequestId::class;
    }

    public function getName(): string
    {
        return 'loan_approved_request_id';
    }
}