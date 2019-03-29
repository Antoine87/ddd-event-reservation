<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\EventReservation\Ticket;

interface TicketRepositoryInterface
{
    /**
     * @return Ticket[]
     */
    public function findAllTickets(): array;

    public function generateTicketNumber(): string;
}
