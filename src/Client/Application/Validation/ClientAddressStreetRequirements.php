<?php

declare(strict_types=1);

namespace App\Client\Application\Validation;

use Symfony\Component\Validator\Constraints as Assert;

#[\Attribute]
final class ClientAddressStreetRequirements extends Assert\Compound
{
    protected function getConstraints(array $options): array
    {
        return [
            new Assert\NotBlank(message: 'Street of address cannot be blank.'),
            new Assert\Length(
                max: 255,
                maxMessage: 'Street cannot be longer than {{ limit }} characters.'
            )
        ];
    }
}