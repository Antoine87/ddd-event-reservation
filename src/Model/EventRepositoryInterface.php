<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\EventReservation\Event;
use App\Model\EventReservation\EventId;

interface EventRepositoryInterface
{
    /**
     * @return Event[]
     */
    public function findAllEvents(): array;

    public function findOneBySlug(string $slug): ?Event;

    public function generateId(): EventId;
}
