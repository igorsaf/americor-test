<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use InvalidArgumentException;
use Stringable;
use Symfony\Component\Uid\Uuid;

abstract readonly class AbstractValueObjectUuid implements Stringable
{

    final private function __construct(protected string $value)
    {
        $this->isValid($this->value);
    }

    final public static function fromString(string $value): static
    {
        return new static($value);
    }

    final public static function next(): static
    {
        return new static(Uuid::v4()->toString());
    }

    final public function value(): string
    {
        return $this->value;
    }

    final public function equals(self $other): bool
    {
        return $this->value() === $other->value();
    }

    public function __toString(): string
    {
        return $this->value();
    }

    private function isValid(string $id): void
    {
        if (!Uuid::isValid($id)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', self::class, $id));
        }
    }
}