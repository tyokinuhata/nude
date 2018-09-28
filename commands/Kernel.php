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

    public function getCommands()
    {
        return $this->commands;
    }
}