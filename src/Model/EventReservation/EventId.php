<?php

declare(strict_types=1);

namespace App\Model\EventReservation;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class EventId
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    private function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function fromUuid(UuidInterface $uuid): self
    {
        return new self($uuid);
    }

    public static function fromString(string $uuid): self
    {
        return new self(Uuid::fromString($uuid));
    }

    public static function isValid(string $id): bool
    {
        return Uuid::isValid($id);
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    /**
     * @internal For Doctrine
     */
    public function __toString()
    {
        return $this->toString();
    }
}
