<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Orm\Types;

use App\Shared\Domain\ValueObject\AbstractValueObjectPercent;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

abstract class AbstractValueObjectPercentAsIntType extends Type
{
    /**
     * @return class-string<AbstractValueObjectPercent>
     */
    abstract public function getConcreteValueObjectType(): string;

    abstract public function getName(): string;

    public function convertToPHPValue($value, AbstractPlatform $platform): ?AbstractValueObjectPercent
    {
        if ($value === null) {
            return null;
        }

        if (is_numeric($value)) {
            /** @var AbstractValueObjectPercent $concreteValueObjectType */
            $concreteValueObjectType = $this->getConcreteValueObjectType();

            return $concreteValueObjectType::fromBasisPoints((int) $value);
        }

        /** @psalm-suppress MixedArgument */
        throw ConversionException::conversionFailed($value, $this->getName());
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof AbstractValueObjectPercent) {
            return (string) $value->toBasisPoints();
        }

        /** @psalm-suppress MixedArgument */
        throw ConversionException::conversionFailed($value, $this->getName());
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getIntegerTypeDeclarationSQL($column);
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}