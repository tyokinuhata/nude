<?php

namespace Commands;

use Core\Commands\Command;

class ServerCommand extends Command
{
    protected $name = 'server';

    protected $description = 'Nude server command';

    public function run()
    {
        color('Nude server started!', 'light-green');
        exec('php -S localhost:8000 -t public');
    }
}