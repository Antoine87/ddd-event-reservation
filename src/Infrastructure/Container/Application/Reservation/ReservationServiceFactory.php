<?php

declare(strict_types=1);

namespace App\Infrastructure\Container\Application\Reservation;

use App\Application\Reservation\ReservationService;
use App\Application\Service\MailerServiceInterface;
use App\Model\EventRepositoryInterface;
use App\Model\EventReservationRepositoryInterface;
use App\Model\TicketRepositoryInterface;
use Psr\Container\ContainerInterface;

class ReservationServiceFactory
{
    public function __invoke(ContainerInterface $container): ReservationService
    {
        return new ReservationService(
            $container->get(EventReservationRepositoryInterface::class),
            $container->get(EventRepositoryInterface::class),
            $container->get(TicketRepositoryInterface::class),
            $container->get(MailerServiceInterface::class)
        );
    }
}
