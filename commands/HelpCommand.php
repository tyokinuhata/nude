<?php

namespace Commands;

use Core\Commands\Command;

class HelpCommand extends Command
{
    protected $name = 'help';

    protected $description = 'Help command';

    public function run()
    {
        $commands = (new Kernel())->getCommands();
        var_dump($commands);

        foreach ($commands as $command) {
            $commandObj = new $command();
            color($commandObj->getName() . ': ' . $commandObj->getDescription(), 'light-green');
        }
    }
}