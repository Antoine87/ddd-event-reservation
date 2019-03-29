<?php

declare(strict_types=1);

namespace App\Infrastructure\ORM\Fixtures;

use App\Model\EventRepositoryInterface;
use App\Model\EventReservation\Event;
use App\Model\EventReservation\Person;
use App\Model\EventReservation\Ticket;
use App\Model\TicketRepositoryInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class FixturesLoader extends AbstractFixture
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var Generator
     */
    private $faker;

    /** @var Event[] */
    private $events = [];
    /** @var Person[] */
    private $persons = [];
    /** @var Ticket[] */
    private $tickets = [];


    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        $this->faker = Factory::create();

        $this
            ->loadEvents()
            ->loadPersons()
            ->loadTicket()
        ;
        $this->manager->flush();
    }

    public function loadEvents(): self
    {
        /** @var EventRepositoryInterface $eventRepository */
        $eventRepository = $this->manager->getRepository(Event::class);

        foreach ($this->getEvents() as $event) {
            $event = new Event(
                $eventRepository->generateId(),
                $event['name'],
                $event['description'],
                $event['image']
            );
            $this->manager->persist($event);
            $this->events[] = $event;
        }

        return $this;
    }

    public function loadPersons(): self
    {
        $person = new Person(
            $this->faker->firstName,
            $this->faker->lastName,
            $this->faker->phoneNumber
        );
        $this->manager->persist($person);
        $this->persons[] = $person;

        return $this;
    }

    public function loadTicket(): self
    {
        /** @var TicketRepositoryInterface $ticketRepository */
        $ticketRepository = $this->manager->getRepository(Ticket::class);

        $ticket = new Ticket(
            $ticketRepository->generateTicketNumber(),
            $this->faker->unique()->randomElement($this->persons)
        );

        $this->manager->persist($ticket);
        $this->tickets[] = $ticket;

        return $this;
    }

    private function getEvents(): array
    {
        return [
            ['name' => 'Lecture', 'description' => 'description', 'image' => 'https://i.imgur.com/BPKhFgM.png'],
            ['name' => 'Concert', 'description' => 'description', 'image' => 'https://i.imgur.com/tazVWuM.jpg'],
            ['name' => 'Sport', 'description' => 'description', 'image' => 'https://i.imgur.com/5jTx4Yo.jpg'],
        ];
    }
}
