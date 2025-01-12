<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Orm\Types;

use App\Shared\Domain\ValueObject\AbstractValueObjectMoney;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

abstract class AbstractValueObjectMoneyAsBigIntType extends Type
{
    /**
     * @return class-string<AbstractValueObjectMoney>
     */
    abstract public function getConcreteValueObjectType(): string;

    abstract public function getName(): string;

    public function convertToPHPValue($value, AbstractPlatform $platform): ?AbstractValueObjectMoney
    {
        if ($value === null) {
            return null;
        }

        if (is_numeric($value)) {
            /** @var AbstractValueObjectMoney $concreteValueObjectType */
            $concreteValueObjectType = $this->getConcreteValueObjectType();

            return $concreteValueObjectType::fromCents((int) $value);
        }

        /** @psalm-suppress MixedArgument */
        throw ConversionException::conversionFailed($value, $this->getName());
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?int
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof AbstractValueObjectMoney) {
            return $value->toCents();
        }

        /** @psalm-suppress MixedArgument */
        throw ConversionException::conversionFailed($value, $this->getName());
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getBigIntTypeDeclarationSQL($column);
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}