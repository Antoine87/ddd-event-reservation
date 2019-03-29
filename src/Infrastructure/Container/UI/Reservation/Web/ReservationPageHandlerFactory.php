<?php

declare(strict_types=1);

namespace App\Infrastructure\Container\UI\Reservation\Web;

use App\UI\Reservation\Facade\ReservationFacadeInterface;
use App\UI\Reservation\Web\ReservationPageHandler;
use App\UI\Reservation\Web\Service\CommandServiceInterface;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ReservationPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): ReservationPageHandler
    {
        return new ReservationPageHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(RouterInterface::class),
            $container->get(ReservationFacadeInterface::class),
            $container->get(CommandServiceInterface::class)
        );
    }
}
