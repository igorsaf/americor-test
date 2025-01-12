<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Orm\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;

abstract class AbstractValueObjectIntAsSmallIntType extends AbstractValueObjectIntAsAbstractIntType
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getSmallIntTypeDeclarationSQL($column);
    }
}
