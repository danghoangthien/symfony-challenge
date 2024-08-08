<?php

// src/Command/SeedUserDataCommand.php

namespace App\Command;

use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SeedUserDataCommand extends Command
{
    protected static $defaultName = 'app:seed-user-data';
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->connection->executeStatement("INSERT INTO user (id, data) VALUES (1, 'Barack - Obama - White House')");
        $this->connection->executeStatement("INSERT INTO user (id, data) VALUES (2, 'Britney - Spears - America')");
        $this->connection->executeStatement("INSERT INTO user (id, data) VALUES (3, 'Leonardo - DiCaprio - Titanic')");

        $output->writeln('Dummy data has been inserted.');

        return Command::SUCCESS;
    }
}
