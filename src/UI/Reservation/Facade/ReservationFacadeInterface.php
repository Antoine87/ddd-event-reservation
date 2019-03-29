<?php

declare(strict_types=1);

namespace App\UI\Reservation\Facade;

use App\UI\Reservation\Facade\Assembler\DTO\EventDTO;

interface ReservationFacadeInterface
{
    /**
     * @return EventDTO[]
     */
    public function listAllEvents(): array;
}
