<?php

/**
 * マイグレーションのロールバックと再度マイグレーション実行を行うコマンド
 */

namespace Commands;

use Core\Commands\Command;

class MigrationRefreshCommand extends Command
{
    protected $name = 'migration:refresh';

    protected $description = 'Migration refresh command';

    public function run()
    {
        $files = scandir(__DIR__ . '/../databases/migrations');
        $files = preg_grep('/\.php/', $files);
        $namespace = 'Databases\Migrations\\';

        $migrations = [];
        foreach ($files as $file) {
            $class = str_replace('.php', '', $file);
            $path = $namespace . $class;
            $migrations[] = new $path();
        }

        foreach ($migrations as $migration) {
            $migration->down();
        }

        foreach ($migrations as $migration) {
            $migration->up();
        }
    }
}