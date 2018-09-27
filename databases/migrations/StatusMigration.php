<?php

namespace Databases\Migrations;

use Core\Databases\Migration;

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
            echo color('Migrating... ' . ((new \ReflectionClass($this))->getShortName()), 'light-green');
            $this->databaseHandle->exec($sql);
            echo color('Migrate success! ' . ((new \ReflectionClass($this))->getShortName()), 'light-green');
        } catch (\PDOException $e) {
            echo color('Migrate failed! ' . ((new \ReflectionClass($this))->getShortName()), 'light-red');
            echo color($e->getMessage(), 'light-red');
            echo color($e->getTraceAsString(), 'light-red');
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