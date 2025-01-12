<?php

declare(strict_types=1);

namespace App\Client\Application\Validation;

use Attribute;
use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

#[Attribute]
final class ClientBirthDateRequirements extends Assert\Compound
{
    protected function getConstraints(array $options): array
    {
        $minDate = new DateTimeImmutable()->modify('-125 years')->format('Y-m-d');
        $maxDate = new DateTimeImmutable()->format('Y-m-d');

        return [
            new Assert\NotBlank(message: 'Birth date cannot be blank.'),
            new Assert\Date(message: 'Birth date must be a valid date in format YYYY-MM-DD.'),
            new Assert\LessThanOrEqual(value: $maxDate, message: 'Birth date cannot be less than today.'),
            new Assert\GreaterThanOrEqual(value: $minDate, message: 'Birth date must not be more than 125 years ago.'),
        ];
    }
}