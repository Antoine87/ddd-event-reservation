<?php

declare(strict_types=1);

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'aliases' to alias a service name to another service. The
        // key is the alias name, the value is the service to which it points.
        'aliases' => [
            // Fully\Qualified\ClassOrInterfaceName::class => Fully\Qualified\ClassName::class,
        ],
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            \App\UI\Reservation\Web\Service\HydratorInterface::class   => \App\UI\Reservation\Web\Service\HydratorService::class,
            \App\UI\Reservation\Web\Service\SerializerInterface::class => \App\UI\Reservation\Web\Service\SerializerService::class,

            \App\UI\Handler\PingHandler::class => \App\UI\Handler\PingHandler::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            \Doctrine\ORM\EntityManagerInterface::class => \ContainerInteropDoctrine\EntityManagerFactory::class,

            \App\Application\Console\Command\ClearCacheCommand::class       => \App\Infrastructure\Container\Application\Console\Command\ClearCacheCommandFactory::class,
            \App\Application\Reservation\ReservationServiceInterface::class => \App\Infrastructure\Container\Application\Reservation\ReservationServiceFactory::class,
            \App\Application\Service\MailerServiceInterface::class          => \App\Infrastructure\Container\Application\Service\MailerServiceFactory::class,

            \App\Model\EventRepositoryInterface::class            => \App\Infrastructure\ORM\Repository\EventRepositoryFactory::class,
            \App\Model\EventReservationRepositoryInterface::class => \App\Infrastructure\ORM\Repository\EventReservationRepositoryFactory::class,
            \App\Model\TicketRepositoryInterface::class           => \App\Infrastructure\ORM\Repository\TicketRepositoryFactory::class,

            \App\UI\Handler\DebugHandler::class    => \App\Infrastructure\Container\UI\Handler\DebugHandlerFactory::class,
            \App\UI\Handler\HomePageHandler::class => \App\Infrastructure\Container\UI\Handler\HomePageHandlerFactory::class,

            \App\UI\Reservation\Facade\Assembler\EventDTOAssembler::class  => \App\Infrastructure\Container\UI\Reservation\Facade\Assembler\EventDTOAssemblerFactory::class,
            \App\UI\Reservation\Facade\ReservationFacadeInterface::class   => \App\Infrastructure\Container\UI\Reservation\Facade\ReservationFacadeFactory::class,
            \App\UI\Reservation\Web\ReservationPageHandler::class          => \App\Infrastructure\Container\UI\Reservation\Web\ReservationPageHandlerFactory::class,
            \App\UI\Reservation\Web\ReservationSubmitHandler::class        => \App\Infrastructure\Container\UI\Reservation\Web\ReservationSubmitHandlerFactory::class,
            \App\UI\Reservation\Web\Service\CommandServiceInterface::class => \App\Infrastructure\Container\UI\Reservation\Web\Service\CommandServiceFactory::class,
        ],
    ],
];
