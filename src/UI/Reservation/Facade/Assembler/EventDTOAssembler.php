<?php

declare(strict_types=1);

namespace App\UI\Reservation\Facade\Assembler;

use App\Model\EventReservation\Event;
use App\UI\Reservation\Facade\Assembler\DTO\EventDTO;

class EventDTOAssembler
{
    public function fromEvent(Event $event): EventDTO
    {
        $dto = new EventDTO(
            $event->getSlug(),
            $event->getName(),
            $event->getDescription(),
            $event->getImage()
        );

        return $dto;
    }
}
