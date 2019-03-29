<?php

declare(strict_types=1);

namespace App\Application\Reservation\Exception;

use OutOfBoundsException;

use function sprintf;

final class EventNotFoundException extends OutOfBoundsException
{
    public static function fromEventName(string $name): self
    {
        return new self(sprintf(
            'No event found for slug: "%s"',
            $name
        ));
    }
}
