<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Orm\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;

abstract class AbstractValueObjectIntAsIntType extends AbstractValueObjectIntAsAbstractIntType
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getIntegerTypeDeclarationSQL($column);
    }
}
