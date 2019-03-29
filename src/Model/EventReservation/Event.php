<?php

declare(strict_types=1);

namespace App\Model\EventReservation;

class Event
{
    /**
     * @var EventId
     */
    private $eventId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $image;

    public function __construct(EventId $eventId, string $name, string $slug, string $description, string $image)
    {
        $this->eventId = $eventId;
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
        $this->image = $image;
    }

    public function getEventId(): EventId
    {
        return $this->eventId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}
