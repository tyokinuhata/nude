<?php

namespace Commands;

use Core\Commands\Command;

class MigrationResetCommand extends Command
{
    protected $name = 'migration:reset';

    protected $description = 'Migration reset command';

    public function run($class = null)
    {
        // 特定のマイグレーションのみ実行
        if (!is_null($class)) {
            $namespace = 'Databases\Migrations\\' . $class;
            $migration = new $namespace();
            $migration->up();
        }
        // 全てのマイグレーションを実行
        else {
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
}