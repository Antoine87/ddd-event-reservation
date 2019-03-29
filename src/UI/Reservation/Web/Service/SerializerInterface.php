<?php

declare(strict_types=1);

namespace App\UI\Reservation\Web\Service;

interface SerializerInterface
{
    /**
     * Generates a storable representation of a value.
     *
     * @param  mixed $value Data to serialize
     * @return string
     */
    public function serialize($value);

    /**
     * Creates a PHP value from a stored representation.
     *
     * @param  string $serialized Serialized string
     * @return mixed
     */
    public function unserialize($serialized);
}
