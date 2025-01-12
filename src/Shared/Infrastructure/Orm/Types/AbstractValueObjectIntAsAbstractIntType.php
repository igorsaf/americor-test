<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Orm\Types;

use App\Shared\Domain\ValueObject\AbstractValueObjectInt;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

abstract class AbstractValueObjectIntAsAbstractIntType extends Type
{
    /**
     * @return class-string<AbstractValueObjectInt>
     */
    abstract public function getConcreteValueObjectType(): string;

    abstract public function getName(): string;

    public function convertToPHPValue($value, AbstractPlatform $platform): ?AbstractValueObjectInt
    {
        if ($value === null) {
            return null;
        }

        if (is_numeric($value)) {
            /** @var AbstractValueObjectInt $concreteValueObjectType */
            $concreteValueObjectType = $this->getConcreteValueObjectType();

            return $concreteValueObjectType::fromInt((int) $value);
        }

        /** @psalm-suppress MixedArgument */
        throw ConversionException::conversionFailed($value, $this->getName());
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof AbstractValueObjectInt) {
            return (string) $value->value();
        }

        /** @psalm-suppress MixedArgument */
        throw ConversionException::conversionFailed($value, $this->getName());
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
