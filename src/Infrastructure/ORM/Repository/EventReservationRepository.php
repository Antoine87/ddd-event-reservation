<?php

declare(strict_types=1);

namespace App\Infrastructure\ORM\Repository;

use App\Model\EventReservation\EventReservation;
use App\Model\EventReservation\EventReservationId;
use App\Model\EventReservationRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Ramsey\Uuid\Uuid;

class EventReservationRepository extends EntityRepository implements EventReservationRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct(
            $entityManager,
            $entityManager->getClassMetadata(EventReservation::class)
        );
    }

    public function generateId(): EventReservationId
    {
        return EventReservationId::fromUuid(Uuid::uuid4());
    }

    /**
     * @param EventReservation $eventReservation
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(EventReservation $eventReservation): void
    {
        $this->_em->persist($eventReservation->getReservedTicket());
        $this->_em->persist($eventReservation->getPerson());
        $this->_em->persist($eventReservation);
        $this->_em->flush();
    }
}
