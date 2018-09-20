<?php

namespace Database\Migrations;

use Core\Database\Migration;

class FollowingMigration extends Migration
{
    public function up()
    {
        $sql = 'CREATE TABLE `following` (
            `id` INTEGER PRIMARY KEY,
            `user_id` INTEGER NOT NULL UNIQUE,
            `following_id` INTEGER NOT NULL UNIQUE,
            FOREIGN KEY (user_id) REFERENCES user(id),
            FOREIGN KEY (following_id) REFERENCES user(id)
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