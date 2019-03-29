<?php

declare(strict_types=1);

namespace App\Infrastructure\Container\UI\Handler;

use App\UI\Handler\DebugHandler;
use Psr\Container\ContainerInterface;

class DebugHandlerFactory
{
    public function __invoke(ContainerInterface $container) : DebugHandler
    {
        return new DebugHandler($container);
    }
}
