<?php

declare(strict_types=1);

namespace App\Application\Console\Command;

use App\Infrastructure\ORM\Fixtures\FixturesLoader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FixturesCommand extends Command
{
    protected static $defaultName = 'app:fixtures:load';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Load fixtures to the configured database.')
            ->addOption(
                'append',
                'a',
                InputOption::VALUE_NONE,
                'Append fixtures (by default data are purged)'
            )
            ->addOption(
                'truncate',
                't',
                InputOption::VALUE_NONE,
                'Purge the database using TRUNCATE instead of DELETE'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $options = $input->getOptions();

        $loader = new Loader();
        $loader->addFixture(new FixturesLoader());

        $purger = new ORMPurger();
        $purger->setPurgeMode($options['truncate'] ? ORMPurger::PURGE_MODE_TRUNCATE : ORMPurger::PURGE_MODE_DELETE);

        $executor = new ORMExecutor($this->entityManager, $purger);
        $executor->execute($loader->getFixtures(), $options['append']);

        return static::EXIT_STATUS_SUCCESS;
    }
}
