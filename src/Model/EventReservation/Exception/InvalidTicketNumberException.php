<?php

declare(strict_types=1);

namespace App\Model\EventReservation\Exception;

use InvalidArgumentException;

class InvalidTicketNumberException extends InvalidArgumentException
{
    public static function fromNumber(string $number): self
    {
        return new self(sprintf(
            'Invalid ticket number: %s',
            $number
        ));
    }
}
