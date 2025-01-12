<?php

declare(strict_types=1);

namespace App\Client\Application\Validation;

use Symfony\Component\Validator\Constraints as Assert;

#[\Attribute]
final class ClientPhoneRequirements extends Assert\Compound
{
    protected function getConstraints(array $options): array
    {
        return [
            new Assert\NotBlank(message: 'Phone number cannot be blank.'),
            new Assert\Regex(
                pattern: '/^\+?1?\d{10,15}$/',
                message: 'Phone number must be a valid international format.'
            )
        ];
    }
}