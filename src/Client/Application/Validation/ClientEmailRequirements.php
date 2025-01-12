<?php

declare(strict_types=1);

namespace App\Client\Application\Validation;

use Symfony\Component\Validator\Constraints as Assert;

#[\Attribute]
final class ClientEmailRequirements extends Assert\Compound
{
    protected function getConstraints(array $options): array
    {
        return [
            new Assert\NotBlank(message: 'Email cannot be blank.'),
            new Assert\Email(message: 'Invalid email format.'),
            new Assert\Length(
                max: 255,
                maxMessage: 'Email cannot be longer than {{ limit }} characters.'
            )
        ];
    }
}