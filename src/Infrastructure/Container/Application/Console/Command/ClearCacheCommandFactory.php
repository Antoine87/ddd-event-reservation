<?php

declare(strict_types=1);

namespace App\Infrastructure\Container\Application\Console\Command;

use App\Application\Console\Command\ClearCacheCommand;
use Psr\Container\ContainerInterface;

class ClearCacheCommandFactory
{
    public function __invoke(ContainerInterface $container): ClearCacheCommand
    {
        return new ClearCacheCommand(
            $container->get('config')
        );
    }
}
