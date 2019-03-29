<?php

declare(strict_types=1);

namespace App\Infrastructure\ORM\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Interop\Container\ContainerInterface;

class EventRepositoryFactory
{
    public function __invoke(ContainerInterface $container): EventRepository
    {
        return new EventRepository(
            $container->get(EntityManagerInterface::class)
        );
    }
}
