<?php

declare(strict_types=1);

namespace App\Model\EventReservation;

use App\Model\EventReservation\Exception\InvalidTicketNumberException;
use DateTimeImmutable;
use DateTimeInterface;

class Ticket
{
    /**
     * @var string
     */
    private $ticketNumber;

    /**
     * @var Person
     */
    private $underName;

    /**
     * @var DateTimeInterface
     */
    private $dateIssued;

    public function __construct(string $ticketNumber, Person $underName)
    {
        if (!self::isValidTicketNumber($ticketNumber)) {
            throw InvalidTicketNumberException::fromNumber($ticketNumber);
        }

        $this->ticketNumber = $ticketNumber;
        $this->underName = $underName;
        $this->dateIssued = new DateTimeImmutable();
    }

    public static function isValidTicketNumber(string $number): bool
    {
        /** @todo */
        return true;
    }

    public function getTicketNumber(): string
    {
        return $this->ticketNumber;
    }

    public function getUnderName(): Person
    {
        return $this->underName;
    }

    public function getDateIssued(): DateTimeInterface
    {
        return $this->dateIssued;
    }
}
