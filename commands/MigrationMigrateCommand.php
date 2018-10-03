<?php

/**
 * マイグレーション実行コマンド
 */

namespace Commands;

use Core\Commands\Command;

class MigrationMigrateCommand extends Command
{
    protected $name = 'migration:migrate';

    protected $description = 'Migrate command';

    public function handle($class = null)
    {
        // 特定のマイグレーションのみ実行
        if (!is_null($class)) {
            $this->run('Databases\Migrations\\' . $class);
        }
        // 全てのマイグレーションを実行
        else {
            $files = scandir(__DIR__ . '/../databases/migrations');
            $files = preg_grep('/\.php/', $files);

            foreach ($files as $file) {
                $class = str_replace('.php', '', $file);
                $this->run('Databases\Migrations\\' . $class);
            }
        }
    }

    private function run($namespace)
    {
        $migration = new $namespace();
        $migration->up();
    }
}