<?php

declare(strict_types=1);

namespace App\Infrastructure\Container\UI\Reservation\Web;

use App\Application\Reservation\ReservationServiceInterface;
use App\UI\Reservation\Web\ReservationSubmitHandler;
use App\UI\Reservation\Web\Service\CommandServiceInterface;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;

class ReservationSubmitHandlerFactory
{
    public function __invoke(ContainerInterface $container): ReservationSubmitHandler
    {
        return new ReservationSubmitHandler(
            $container->get(RouterInterface::class),
            $container->get(ReservationServiceInterface::class),
            $container->get(CommandServiceInterface::class)
        );
    }
}
