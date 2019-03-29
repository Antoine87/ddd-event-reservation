<?php

declare(strict_types=1);

namespace App\Infrastructure\ORM\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class EventIdType extends Type
{
    public const NAME = 'event_id';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getGuidTypeDeclarationSQL($fieldDeclaration);
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
