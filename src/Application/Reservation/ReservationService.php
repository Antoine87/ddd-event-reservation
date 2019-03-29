<?php

declare(strict_types=1);

namespace App\Application\Reservation;

use App\Application\Reservation\Exception\EventNotFoundException;
use App\Application\Service\MailerServiceInterface;
use App\Model\EventRepositoryInterface;
use App\Model\EventReservation\EventReservation;
use App\Model\EventReservation\Person;
use App\Model\EventReservation\Ticket;
use App\Model\EventReservationRepositoryInterface;
use App\Model\TicketRepositoryInterface;

use function file_get_contents;
use function str_replace;

class ReservationService implements ReservationServiceInterface
{
    private $reservationRepository;
    private $eventRepository;
    private $ticketRepository;
    private $mailer;

    public function __construct(
        EventReservationRepositoryInterface $reservationRepository,
        EventRepositoryInterface $eventRepository,
        TicketRepositoryInterface $ticketRepository,
        MailerServiceInterface $mailer
    ) {
        $this->reservationRepository = $reservationRepository;
        $this->eventRepository = $eventRepository;
        $this->ticketRepository = $ticketRepository;
        $this->mailer = $mailer;
    }

    public function makeReservation(NewReservationCommand $command): void
    {
        $event = $this->eventRepository->findOneBySlug($command->getEventSlug());

        if (!$event) {
            throw EventNotFoundException::fromEventName($event->getName());
        }

        $person = new Person(
            $command->getPersonGivenName(),
            $command->getPersonEmail(),
            $command->getPersonFamilyName(),
            $command->getPersonTelephone()
        );

        $ticket = new Ticket($this->ticketRepository->generateTicketNumber(), $person);

        $eventReservation = new EventReservation($this->reservationRepository->generateId(), $event, $ticket, $person);

        $this->reservationRepository->save($eventReservation);

        $mailMarkdownContent = $this->getMailContent(
            'mail/confirmation.md',
            $event->getName(),
            $person->getGivenName(),
            $person->getEmail(),
            $ticket->getTicketNumber()
        );

        $this->mailer->sendMarkdown($mailMarkdownContent, $person->getEmail(), 'Reservation confirmation');
    }

    // @todo
    private function getMailContent(
        string $template,
        string $eventName,
        string $personName,
        string $personEmail,
        string $ticketNumber
    ): string {
        $template = file_get_contents(__DIR__ . '/templates/' . $template);
        $template = str_replace(
            ['{{event}}', '{{name}}', '{{email}}', '{{ticket}}'],
            [$eventName, $personName, $personEmail, $ticketNumber],
            $template
        );

        return $template;
    }
}
