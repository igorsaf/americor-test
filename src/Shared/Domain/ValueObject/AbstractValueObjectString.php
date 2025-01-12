<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;
use Stringable;

abstract readonly class AbstractValueObjectString implements Stringable
{
    final private function __construct(protected string $value)
    {
    }

    final public static function fromString(string $value): static
    {
        return new static($value);
    }

    final public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function isEquals(self $other): bool
    {
        return $other->value() === $this->value();
    }

    /**
     * @param self[] $listOfOther
     */
    public function isInList(array $listOfOther): bool
    {
        return array_any($listOfOther, fn(self $other) => $other->isEquals($other));
    }
}