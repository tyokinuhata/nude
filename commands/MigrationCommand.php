<?php

namespace Commands;

use Core\Commands\Command;

class MigrationCommand extends Command
{
    public function run($method, $options)
    {
        echo $method, $options;
    }
}