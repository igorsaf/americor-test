<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Orm\Types;

use App\Shared\Domain\ValueObject\AbstractValueObjectUuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

abstract class AbstractValueObjectUuidAsUuidType extends Type
{
    /**
     * @return class-string<AbstractValueObjectUuid>
     */
    abstract public function getConcreteValueObjectType(): string;

    abstract public function getName(): string;

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getGuidTypeDeclarationSQL($column);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?AbstractValueObjectUuid
    {
        if ($value === null) {
            return null;
        }

        if (is_string($value)) {
            /** @var AbstractValueObjectUuid $concreteValueObjectType */
            $concreteValueObjectType = $this->getConcreteValueObjectType();

            return $concreteValueObjectType::fromString($value);
        }

        /** @psalm-suppress MixedArgument,PossiblyFalseArgument */
        throw ConversionException::conversionFailed($value, $this->getName());
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof AbstractValueObjectUuid) {
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
