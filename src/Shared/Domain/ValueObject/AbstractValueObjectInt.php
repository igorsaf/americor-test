<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use Stringable;

abstract readonly class AbstractValueObjectInt extends AbstractValueObject implements Stringable
{
    final private function __construct(protected int $value)
    {
    }

    final public static function fromInt(int $value): static
    {
        return new static($value);
    }

    final public function value(): int
    {
        return $this->value;
    }

    final public function isBiggerThan(self $other): bool
    {
        return $this->value() > $other->value();
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}