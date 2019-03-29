<?php

declare(strict_types=1);

namespace App\Application\Console;

use App\Application\Console\Command;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;

chdir(dirname(__DIR__, 3));

require_once 'vendor/autoload.php';

$container = require 'config/container.php';

$application = new Application();

$application->setCommandLoader(
    new ContainerCommandLoader($container, [
        // Production
        Command\ClearCacheCommand::getDefaultName() => Command\ClearCacheCommand::class,

        // Development
        Command\FixturesCommand::getDefaultName() => Command\FixturesCommand::class,
    ])
);

$application->run();
