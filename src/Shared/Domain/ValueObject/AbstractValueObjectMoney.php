<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use Stringable;

abstract readonly class AbstractValueObjectMoney extends AbstractValueObject implements Stringable
{
    final private function __construct(protected int $value)
    {
    }

    public static function fromCents(int $cents): static
    {
        return new static($cents);
    }

    public function toCents(): int
    {
        return $this->value;
    }

    public static function fromAmount(float $amount): static
    {
        return new static((int)($amount*100));
    }

    public function toAmount(): float
    {
        return $this->value / 100;
    }

    public function __toString(): string
    {
        return (string)$this->toAmount();
    }

    public function value(): float
    {
        return $this->toAmount();
    }

    public function isBiggerThan(self $other): bool
    {
        return $this->toCents() > $other->toCents();
    }
}