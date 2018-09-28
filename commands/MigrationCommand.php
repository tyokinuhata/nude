<?php

namespace Commands;

use Core\Commands\Command;

class MigrationCommand extends Command
{
    // コマンドと実際に実行するメソッドのマッピング
    protected $mappings = [
        'migrate' => [ 'up' ],
        'reset' => [ 'down' ],
        'refresh' => [ 'down', 'up' ]
    ];

    public function run()
    {
        $action = func_get_arg(0);
        $class = func_get_arg(1);

        // 全てのマイグレーションを実行
        if (is_null($class)) {
            $files = scandir(__DIR__ . '/../databases/migrations');
            $files = preg_grep('/\.php/', $files);
            $namespace = 'Databases\Migrations\\';

            // インスタンス生成
            $migrations = [];
            foreach ($files as $file) {
                $class = str_replace('.php', '', $file);
                $path = $namespace . $class;
                $migrations[] = new $path();
            }

            // メソッド実行
            $methods = $this->mappings[$action];
            foreach ($methods as $method) {
                foreach ($migrations as $migration) {
                    $migration->$method();
                }
            }
        // 特定のマイグレーションのみ実行
        } else {
            $namespace = 'Databases\Migrations\\' . $class;
            $migration = new $namespace();
            $methods = $this->mappings[$action];
            foreach ($methods as $method) $migration->$method();
        }
    }
}