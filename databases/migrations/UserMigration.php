<?php

namespace Databases\Migrations;

use Core\Databases\Migration;

class UserMigration extends Migration
{
    public function up()
    {
        $sql = 'CREATE TABLE `user` (
            `id` INTEGER PRIMARY KEY,
            `user_name` VARCHAR(20) NOT NULL UNIQUE,
            `password` VARCHAR(40) NOT NULL,
            `created_at` DATETIME
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