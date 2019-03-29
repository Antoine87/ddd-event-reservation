<?php

declare(strict_types=1);

namespace App\Infrastructure\Container\UI\Reservation\Facade\Assembler;

use App\UI\Reservation\Facade\Assembler\EventDTOAssembler;
use Psr\Container\ContainerInterface;

class EventDTOAssemblerFactory
{
    public function __invoke(ContainerInterface $container): EventDTOAssembler
    {
        return new EventDTOAssembler();
    }
}
