<?php

namespace Database\Migrations;

use Core\Database\Migration;

class UserMigration extends Migration
{
    public function __construct()
    {
        parent::__construct();
    }

    public function up()
    {
        $sql = 'CREATE TABLE `user` (
            `id` INTEGER PRIMARY KEY,
            `user_name` VARCHAR(20) NOT NULL UNIQUE,
            `password` VARCHAR(40) NOT NULL,
            `created_at` DATETIME
	    )';

        try {
            $this->databaseHandle->exec($sql);
        } catch (\PDOException $e) {
            echo $e->getMessage() . "\n";
            echo $e->getTraceAsString() . "\n";
            die();
        }
    }

    public function down()
    {
        try {
            $file = new \SplFileObject($this->databaseSource, 'wb');
        } catch (\Exception $e) {
            echo $e->getMessage() . "\n";
            echo $e->getTraceAsString() . "\n";
            die();
        }

        $res = $file->fwrite('');
        if ($res === false) {
            echo "Couldn't save this file.\n";
            die();
        }
    }
}