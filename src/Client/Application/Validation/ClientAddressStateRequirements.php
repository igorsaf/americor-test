<?php

declare(strict_types=1);

namespace App\Client\Application\Validation;

use Symfony\Component\Validator\Constraints as Assert;

#[\Attribute]
final class ClientAddressStateRequirements extends Assert\Compound
{
    protected function getConstraints(array $options): array
    {
        return [
            new Assert\NotBlank(message: 'State cannot be blank.'),
            new Assert\Regex(
                pattern: '/^[A-Za-z]{2}$/',
                message: 'State must consist of exactly two letters.'
            )
        ];
    }
}