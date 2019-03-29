<?php

declare(strict_types=1);

namespace App\Infrastructure\Container\UI\Reservation\Web\Service;

use App\UI\Reservation\Web\Service\CommandService;
use App\UI\Reservation\Web\Service\HydratorInterface;
use App\UI\Reservation\Web\Service\SerializerInterface;
use Psr\Container\ContainerInterface;

class CommandServiceFactory
{
    public function __invoke(ContainerInterface $container): CommandService
    {
        return new CommandService(
            $container->get(HydratorInterface::class),
            $container->get(SerializerInterface::class)
        );
    }
}
