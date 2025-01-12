<?php

declare(strict_types=1);

namespace App\Loan\Application\Validation;

use Attribute;
use Symfony\Component\Validator\Constraints as Assert;

#[Attribute]
final class ClientMonthlyIncomeRequirements extends Assert\Compound
{

    protected function getConstraints(array $options): array
    {
        return [
            new Assert\NotBlank(message: 'Monthly income cannot be blank.'),
            new Assert\PositiveOrZero(message: 'Monthly income must be zero or a positive number.'),
        ];
    }
}