<?php

declare(strict_types=1);

namespace App\Application\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use function file_exists;
use function sprintf;
use function unlink;

class ClearCacheCommand extends Command
{
    protected static $defaultName = 'app:clear-config-cache';

    private $containerConfig;

    public function __construct(array $containerConfig)
    {
        $this->containerConfig = $containerConfig;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Delete the configuration cache file (see config/config.php)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $config = $this->containerConfig;

        if (!isset($config['config_cache_path'])) {
            $io->note('No configuration cache path found.');
            return static::EXIT_STATUS_SUCCESS;
        }

        if (!file_exists($config['config_cache_path'])) {
            $io->warning(sprintf(
                'Configured config cache file "%s" not found.%s' .
                'Is the application running in development mode ?',
                $config['config_cache_path'],
                PHP_EOL
            ));
            return static::EXIT_STATUS_WARNING;
        }

        if (false === unlink($config['config_cache_path'])) {
            $io->text(sprintf(
                'Error removing config cache file "%s".',
                $config['config_cache_path']
            ));
            return static::EXIT_STATUS_ERROR;
        }

        $io->success(sprintf(
            'Removed configured config cache file "%s".',
            $config['config_cache_path']
        ));
        return static::EXIT_STATUS_SUCCESS;
    }
}
