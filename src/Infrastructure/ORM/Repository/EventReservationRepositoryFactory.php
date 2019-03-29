<?php

declare(strict_types=1);

namespace App\Infrastructure\ORM\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Interop\Container\ContainerInterface;

class EventReservationRepositoryFactory
{
    public function __invoke(ContainerInterface $container): EventReservationRepository
    {
        return new EventReservationRepository(
            $container->get(EntityManagerInterface::class)
        );
    }
}
