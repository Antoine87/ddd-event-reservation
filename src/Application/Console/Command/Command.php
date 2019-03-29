<?php

declare(strict_types=1);

namespace App\Application\Console\Command;

use Symfony\Component\Console\Command\Command as BaseCommand;

abstract class Command extends BaseCommand
{
    public const EXIT_STATUS_SUCCESS    = 0;
    public const EXIT_STATUS_ERROR      = 1;
    public const EXIT_STATUS_WARNING    = 2;
}
