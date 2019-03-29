<?php

declare(strict_types=1);

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once dirname(__DIR__) . '/vendor/autoload.php';

/** @var \Psr\Container\ContainerInterface $container */
$container = require 'container.php';

return ConsoleRunner::createHelperSet(
    $container->get(EntityManagerInterface::class)
);
