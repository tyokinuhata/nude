<?php

/**
 * コマンドのヘルプ表示
 */

namespace Commands;

use Core\Commands\Command;

class HelpCommand extends Command
{
    protected $name = 'help';

    protected $description = 'Help command';

    public function handle()
    {
        $commands = (new Kernel())->getCommands();

        $helps = [];
        foreach ($commands as $command) {
            $commandObj = new $command();
            $commandName = $commandObj->getName();
            $commandDescription = $commandObj->getDescription();

            if (strpos($commandName, ':')) {
                $parentName = explode(':', $commandName)[0];
                $childName = explode(':', $commandName)[1];
            } else {
                $parentName = $commandName;
                $childName = $commandName;
            }

            if (!isset($helps[$parentName])) $helps[$parentName] = [];
            $helps[$parentName][] = $childName . ' => ' . $commandDescription;
        }

        foreach ($helps as $key => $items) {
            color($key . ': ', 'light-green');
            foreach ($items as $item) color($item, 'light-green');
            echo "\n";
        }
    }
}