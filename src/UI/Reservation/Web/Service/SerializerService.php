<?php

declare(strict_types=1);

namespace App\UI\Reservation\Web\Service;

use Zend\Serializer\Adapter\PhpSerialize;

class SerializerService implements SerializerInterface
{
    private $serializer;

    public function __construct()
    {
        $this->serializer = new PhpSerialize();
    }

    public function serialize($value)
    {
        return $this->serializer->serialize($value);
    }

    public function unserialize($serialized)
    {
        return $this->serializer->unserialize($serialized);
    }
}
