<?php

declare(strict_types=1);

namespace App\Application\Reservation;

interface ReservationServiceInterface
{
    public function makeReservation(NewReservationCommand $command): void;
}
