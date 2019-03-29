<?php

declare(strict_types=1);

namespace App\UI\Reservation\Facade\Assembler\DTO;


use App\UI\Reservation\Facade\Assembler\DTO\Exception\DataModificationException;
use App\UI\Reservation\Facade\Assembler\DTO\Exception\UndefinedDataException;
use function property_exists;

trait PropertyAccessTrait
{
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw UndefinedDataException::fromName($name);
    }

    public function __set($name, $value)
    {
        throw DataModificationException::fromName($name);
    }
}
