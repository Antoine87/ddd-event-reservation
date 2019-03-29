<?php

declare(strict_types=1);

namespace App\UI\Reservation\Facade;

use App\Model\EventRepositoryInterface;
use App\UI\Reservation\Facade\Assembler\DTO\EventDTO;
use App\UI\Reservation\Facade\Assembler\EventDTOAssembler;

class ReservationFacade implements ReservationFacadeInterface
{
    private $eventRepository;
    private $eventDTOAssembler;

    public function __construct(
        EventRepositoryInterface $eventRepository,
        EventDTOAssembler $eventDTOAssembler
    ) {
        $this->eventRepository = $eventRepository;
        $this->eventDTOAssembler = $eventDTOAssembler;
    }

    /**
     * @return EventDTO[]
     */
    public function listAllEvents(): array
    {
        $events = $this->eventRepository->findAllEvents();
        $eventDTOs = [];

        foreach ($events as $event) {
            $eventDTOs[] = $this->eventDTOAssembler->fromEvent($event);
        }

        return $eventDTOs;
    }
}
