<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use Stringable;

abstract readonly class AbstractValueObjectPercent implements Stringable
{

    final private function __construct(protected int $value)
    {
    }

    public static function fromBasisPoints(int $basisPoints): static
    {
        return new static($basisPoints);
    }

    public static function fromPercentage(float $percentage): static
    {
        return new static((int)($percentage * 100));
    }

    public function toBasisPoints(): int
    {
        return $this->value;
    }

    public function toPercentage(): float
    {
        return $this->value / 100;
    }

    public function toDecimal(): float
    {
        return $this->value / 10000;
    }

    public function value(): float
    {
        return $this->toDecimal();
    }

    public function add(self $other): static
    {
        return new static($this->value + $other->toBasisPoints());
    }

    public function __toString(): string
    {
        return (string)$this->toPercentage();
    }
}