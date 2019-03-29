<?php

declare(strict_types=1);

namespace App\Infrastructure\ORM\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Interop\Container\ContainerInterface;

class TicketRepositoryFactory
{
    public function __invoke(ContainerInterface $container): TicketRepository
    {
        return new TicketRepository(
            $container->get(EntityManagerInterface::class)
        );
    }
}
