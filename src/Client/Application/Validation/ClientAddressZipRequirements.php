<?php

declare(strict_types=1);

namespace App\Client\Application\Validation;

use Symfony\Component\Validator\Constraints as Assert;

#[\Attribute]
final class ClientAddressZipRequirements extends Assert\Compound
{
    protected function getConstraints(array $options): array
    {
        return [
            new Assert\NotBlank(message: 'ZIP code cannot be blank.'),
            new Assert\Regex(
                pattern: '/^\d{5}(-\d{4})?$/',
                message: 'ZIP code must be a valid US ZIP code.'
            )
        ];
    }
}