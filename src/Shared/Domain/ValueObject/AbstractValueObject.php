<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract readonly class AbstractValueObject
{
    abstract public function value(): string|int|float|bool;
}