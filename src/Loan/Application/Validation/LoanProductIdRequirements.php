<?php

declare(strict_types=1);

namespace App\Loan\Application\Validation;

use Attribute;
use Symfony\Component\Validator\Constraints as Assert;

#[Attribute]
final class LoanProductIdRequirements extends Assert\Compound
{

    protected function getConstraints(array $options): array
    {
        return [
            new Assert\NotBlank(message: 'Loan product id cannot be blank.'),
            new Assert\Uuid(message: 'Loan product id must be a valid UUID.')
        ];
    }
}