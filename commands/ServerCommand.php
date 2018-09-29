<?php

/**
 * 鯖起動コマンド
 */

namespace Commands;

use Core\Commands\Command;

class ServerCommand extends Command
{
    protected $name = 'server';

    protected $description = 'Nude server command';

    public function handle($port = 8000)
    {
        color("Nude server started on port localhost:$port", 'light-green');
        exec("php -S localhost:$port -t public");
    }
}