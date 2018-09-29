<?php

namespace Commands;

class Kernel
{
    /**
     * @var array
     * コマンド一覧
     */
    private $commands = [
        HelpCommand::class,
        ServerCommand::class,
        MigrationMigrateCommand::class,
        MigrationResetCommand::class,
        MigrationRefreshCommand::class,
    ];

    /**
     * Kernel constructor.
     * @param null $argv
     * コマンド実行処理
     */
    public function __construct($argv = null)
    {
        foreach ($this->getCommands() as $command) {
            $commandObj = new $command();
            $commandName = $commandObj->getName();
            if ($commandName === $argv[1]) {
                isset($argv[2]) ? $commandObj->run($argv[2]) : $commandObj->run();
                exit();
            }
        }
        color('Command not found.', 'light-red');
    }

    /**
     * @return array
     * コマンド一覧を取得
     */
    public function getCommands()
    {
        return $this->commands;
    }
}