<?php

declare(strict_types=1);

namespace App\Model\EventReservation;

class EventReservation
{
    /**
     * @var EventReservationId
     */
    private $reservationId;

    /**
     * @var Event
     */
    private $reservationFor;

    /**
     * @var Ticket
     */
    private $reservedTicket;

    /**
     * @var Person
     */
    private $underName;

    public function __construct(
        EventReservationId $reservationId,
        Event $reservationFor,
        Ticket $reservedTicket,
        Person $underName
    ) {
        $this->reservationId = $reservationId;
        $this->reservationFor = $reservationFor;
        $this->reservedTicket = $reservedTicket;
        $this->underName = $underName;
    }

    public function getReservationId(): EventReservationId
    {
        return $this->reservationId;
    }

    public function getReservationFor(): Event
    {
        return $this->reservationFor;
    }

    public function getReservedTicket(): Ticket
    {
        return $this->reservedTicket;
    }

    public function getPerson(): Person
    {
        return $this->underName;
    }
}
