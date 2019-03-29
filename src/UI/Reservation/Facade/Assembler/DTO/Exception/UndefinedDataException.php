<?php

declare(strict_types=1);

namespace App\UI\Reservation\Facade\Assembler\DTO\Exception;

use function sprintf;

final class UndefinedDataException extends \LogicException
{
    public static function fromName(string $name): self
    {
        return new self(sprintf(
            'The "%s" property does not exist.',
            $name
        ));
    }
}
