<?php

declare(strict_types=1);

namespace App\Loan\Application\Validation;

use Symfony\Component\Validator\Constraints as Assert;

#[\Attribute]
final class LoanApprovedRequestIdRequirements extends Assert\Compound
{
    protected function getConstraints(array $options): array
    {
        return [
            new Assert\NotBlank(message: 'Loan approved request id cannot be blank.'),
            new Assert\Uuid(message: 'Loan approved request id must be a valid UUID.')
        ];
    }
}