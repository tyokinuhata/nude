<?php

namespace Commands;

use Core\Commands\Command;

class MigrationResetCommand extends Command
{
    protected $name = 'migration:reset';

    protected $description = 'Reset command';

    public function run()
    {
        $files = scandir(__DIR__ . '/../databases/migrations');
        $files = preg_grep('/\.php/', $files);
        $namespace = 'Databases\Migrations\\';

        foreach ($files as $file) {
            $class = str_replace('.php', '', $file);
            $path = $namespace . $class;
            $migration = new $path();
            $migration->down();
        }
    }
}