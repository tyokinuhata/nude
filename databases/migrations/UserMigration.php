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

        $className = (new \ReflectionClass($this))->getShortName();
        try {
            color('Migrating... ' . $className, 'light-green');
            $this->databaseHandle->exec($sql);
            color('Migrate success! ' . $className, 'light-green');
        } catch (\PDOException $e) {
            color('Migrate failed! ' . $className, 'light-red');
            color($e->getMessage(), 'light-red');
            color($e->getTraceAsString(), 'light-red');
            die();
        }
    }

    public function down()
    {
        $className = (new \ReflectionClass($this))->getShortName();
        try {
            color('Rollback now... ' . $className, 'light-green');
            $file = new \SplFileObject($this->databaseSource, 'wb');
            color('Rollback success! ' . $className, 'light-green');
        } catch (\Exception $e) {
            color($e->getMessage(), 'light-red');
            color($e->getTraceAsString(), 'light-red');
            die();
        }

        $res = $file->fwrite('');
        if ($res === false) {
            color("Couldn't save this file.", 'light-red');
            die();
        }
    }
}