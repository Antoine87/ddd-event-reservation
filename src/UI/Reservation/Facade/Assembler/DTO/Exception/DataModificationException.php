<?php

declare(strict_types=1);

namespace App\UI\Reservation\Facade\Assembler\DTO\Exception;

use function sprintf;

final class DataModificationException extends \LogicException
{
    public static function fromName(string $name): self
    {
        return new self(sprintf(
            'Property modification is forbidden ("%s")',
            $name
        ));
    }
}
