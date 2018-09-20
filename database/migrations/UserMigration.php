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
            `user_name` TEXT NOT NULL UNIQUE,
            `password` TEXT NOT NULL,
            `created_at` TEXT
	    )';

        try {
            $this->databaseHandle->exec($sql);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            echo $e->getTraceAsString();
            die();
        }
    }

    public function down()
    {
        try {
            $file = new \SplFileObject($this->databaseSource, 'wb');
        } catch (\Exception $e) {
            echo $e->getMessage();
            echo $e->getTraceAsString();
            die();
        }

        $res = $file->fwrite('');
        if ($res === false) {
            echo "Couldn't save this file.";
            die();
        }
    }
}