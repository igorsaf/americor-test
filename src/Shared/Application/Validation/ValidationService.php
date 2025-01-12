<?php

declare(strict_types=1);

namespace App\Shared\Application\Validation;

use Symfony\Component\Validator\Validator\ValidatorInterface;

final readonly class ValidationService
{

    public function __construct(
        private ValidatorInterface $validator
    ) {
    }

    /**
     * @throws ValidationFailedException
     */
    public function validate(object $object): void
    {
        $violations = $this->validator->validate($object);

        if ($violations->count() === 0) {
            return;
        }

        $errors = [];
        foreach ($violations as $violation) {
            $errors[] = $violation->getMessage();
        }

        throw new ValidationFailedException($errors);
    }

}