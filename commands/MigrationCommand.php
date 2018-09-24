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

    public function run($action, $class)
    {
        if (is_null($class)) {
            // クラス取得
        } else {
            $namespace = 'Databases\Migrations\\' . $class;
            $migration = new $namespace();
            $methods = $this->mappings[$action];
            foreach ($methods as $method) $migration->$method();
        }
    }
}