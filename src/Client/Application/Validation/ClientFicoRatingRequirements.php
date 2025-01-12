<?php

declare(strict_types=1);

namespace App\Client\Application\Validation;

use Symfony\Component\Validator\Constraints as Assert;

#[\Attribute]
final class ClientFicoRatingRequirements extends Assert\Compound
{
    protected function getConstraints(array $options): array
    {
        return [
            new Assert\NotBlank(message: 'FICO rating cannot be blank.'),
            new Assert\Type(
                type: 'integer',
                message: 'FICO rating must be a valid number.'
            ),
            new Assert\Range(
                min: 300,
                max: 850,
                notInRangeMessage: 'FICO rating must be between {{ min }} and {{ max }}.'
            )
        ];
    }
}