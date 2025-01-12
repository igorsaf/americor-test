<?php

declare(strict_types=1);

namespace App\Client\Application\Validation;

use Symfony\Component\Validator\Constraints as Assert;

#[\Attribute]
final class ClientSsnRequirements extends Assert\Compound
{
    protected function getConstraints(array $options): array
    {
        return [
            new Assert\NotBlank(message: 'SSN cannot be blank.'),
            new Assert\Regex(
                pattern: '/^\d{3}-\d{2}-\d{4}$/',
                message: 'SSN must be in the format XXX-XX-XXXX.'
            )
        ];
    }
}