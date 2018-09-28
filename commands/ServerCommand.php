<?php

namespace Commands;

use Core\Commands\Command;

class ServerCommand extends Command
{
    public function run()
    {
        echo color('Nude server started!', 'light-green');
        exec('php -S localhost:8000 -t public');
    }
}