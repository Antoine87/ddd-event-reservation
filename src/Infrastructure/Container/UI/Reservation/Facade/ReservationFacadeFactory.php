<?php

declare(strict_types=1);

namespace App\Infrastructure\Container\UI\Reservation\Facade;

use App\Model\EventRepositoryInterface;
use App\UI\Reservation\Facade\Assembler\EventDTOAssembler;
use App\UI\Reservation\Facade\ReservationFacade;
use Psr\Container\ContainerInterface;

class ReservationFacadeFactory
{
    public function __invoke(ContainerInterface $container): ReservationFacade
    {
        return new ReservationFacade(
            $container->get(EventRepositoryInterface::class),
            $container->get(EventDTOAssembler::class)
        );
    }
}
