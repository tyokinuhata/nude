<?php

namespace Commands;

class Kernel
{
    private $commands = [
        ServerCommand::class,
        MigrationMigrateCommand::class,
        MigrationResetCommand::class,
        MigrationRefreshCommand::class,
    ];

    public function __construct($argv)
    {
        foreach ($this->commands as $command) {
            $commandObj = new $command();
            $commandName = $commandObj->getName();
            if ($commandName === $argv[1]) {
                isset($argv[2]) ? $commandObj->run($argv[2]) : $commandObj->run();
                exit();
            }
        }
        color('Command not found.', 'light-red');
    }
}