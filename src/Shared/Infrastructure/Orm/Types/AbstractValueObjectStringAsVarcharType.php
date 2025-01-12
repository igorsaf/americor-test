<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Orm\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;

abstract class AbstractValueObjectStringAsVarcharType extends AbstractValueObjectStringAsAbstractStringType
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        if ($this->getColumnLength() !== null) {
            $column['length'] = $this->getColumnLength();
        }

        return $platform->getStringTypeDeclarationSQL($column);
    }

    protected function getColumnLength(): ?int
    {
        return null;
    }
}