<?php

declare(strict_types=1);

namespace App\Shared\Application\Validation;

use App\Shared\Application\Exception\ExceptionWithDetailsInterface;
use Exception;

final class ValidationFailedException extends Exception implements ExceptionWithDetailsInterface
{
    /**
     * @param string[] $errors
     */
    public function __construct(private readonly array $errors) {
        parent::__construct('Validation failed');
    }

    public function getDetails(): array
    {
        return $this->errors;
    }
}