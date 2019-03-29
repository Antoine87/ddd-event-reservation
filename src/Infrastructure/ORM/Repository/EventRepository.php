<?php

declare(strict_types=1);

namespace App\Infrastructure\ORM\Repository;

use App\Model\EventRepositoryInterface;
use App\Model\EventReservation\Event;
use App\Model\EventReservation\EventId;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Ramsey\Uuid\Uuid;

class EventRepository extends EntityRepository implements EventRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct(
            $entityManager,
            $entityManager->getClassMetadata(Event::class)
        );
    }

    /**
     * @return Event[]
     */
    public function findAllEvents(): array
    {
        return $this->findAll();
    }

    public function findOneBySlug(string $slug): ?Event
    {
        return parent::findOneBySlug($slug);
    }

    public function generateId(): EventId
    {
        return EventId::fromUuid(Uuid::uuid4());
    }
}
