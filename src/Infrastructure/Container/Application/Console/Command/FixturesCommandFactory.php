<?php

declare(strict_types=1);

namespace App\Infrastructure\Container\Application\Console\Command;

use App\Application\Console\Command\FixturesCommand;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

class FixturesCommandFactory
{
    public function __invoke(ContainerInterface $container): FixturesCommand
    {
        return new FixturesCommand(
            $container->get(EntityManagerInterface::class)
        );
    }
}
