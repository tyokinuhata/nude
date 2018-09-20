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
            echo $e->getMessage();
            echo $e->getTraceAsString();
            die();
        }
    }

    public function down()
    {
        // TODO: Implement down() method.
    }
}