<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\EventReservation\EventReservation;
use App\Model\EventReservation\EventReservationId;

interface EventReservationRepositoryInterface
{
    public function generateId(): EventReservationId;

    public function save(EventReservation $eventReservation);
}
