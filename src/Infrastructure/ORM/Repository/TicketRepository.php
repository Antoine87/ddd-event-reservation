<?php

declare(strict_types=1);

namespace App\Infrastructure\ORM\Repository;

use App\Model\EventReservation\Ticket;
use App\Model\TicketRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

use function chr;
use function mt_rand;
use function str_pad;

class TicketRepository extends EntityRepository implements TicketRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct(
            $entityManager,
            $entityManager->getClassMetadata(Ticket::class)
        );
    }

    /**
     * @return Ticket[]
     */
    public function findAllTickets(): array
    {
        return $this->findAll();
    }

    /**
     * Pattern: ^[A-Z][0-9]{5}$
     *
     * Example: T12345
     */
    public function generateTicketNumber(): string
    {
        // This can be delegated to the database for better performance if it can generate the required pattern.
        do {
            $newNumber = chr(mt_rand(65, 90)) . str_pad((string)mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
        } while (parent::findOneByTicketNumber($newNumber) !== null);

        return $newNumber;
    }
}
