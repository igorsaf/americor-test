<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Orm\Types;

use App\Shared\Domain\ValueObject\AbstractValueObjectString;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

abstract class AbstractValueObjectStringAsAbstractStringType extends Type
{
    /**
     * @return class-string<AbstractValueObjectString>
     */
    abstract public function getConcreteValueObjectType(): string;

    abstract public function getName(): string;

    public function convertToPHPValue($value, AbstractPlatform $platform): ?AbstractValueObjectString
    {
        if ($value === null) {
            return null;
        }

        if (is_string($value)) {
            /** @var AbstractValueObjectString $concreteValueObjectType */
            $concreteValueObjectType = $this->getConcreteValueObjectType();

            return $concreteValueObjectType::fromString($value);
        }

        throw ConversionException::conversionFailed($value, $this->getName());
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof AbstractValueObjectString) {
            return $value->value();
        }

        /** @psalm-suppress MixedArgument */
        throw ConversionException::conversionFailed($value, $this->getName());
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
