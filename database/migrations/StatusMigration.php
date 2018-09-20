<?php

namespace Database\Migrations;

use Core\Database\Migration;

class StatusMigration extends Migration
{
    public function up()
    {
        $sql = 'CREATE TABLE `status` (
            `id` INTEGER PRIMARY KEY,
            `user_id` INTEGER NOT NULL,
            `body` VARCHAR(255),
            `created_at` DATETIME,
            FOREIGN KEY (user_id) REFERENCES user(id)
        )';

        try {
            $this->databaseHandle->exec($sql);
        } catch (\PDOException $e) {
            echo $e->getMessage() . "\n";;
            echo $e->getTraceAsString() . "\n";;
            die();
        }
    }

    public function down()
    {
        try {
            $file = new \SplFileObject($this->databaseSource, 'wb');
        } catch (\Exception $e) {
            echo $e->getMessage() . "\n";;
            echo $e->getTraceAsString() . "\n";;
            die();
        }

        $res = $file->fwrite('');
        if ($res === false) {
            echo "Couldn't save this file.\n";
            die();
        }
    }
}