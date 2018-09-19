<?php

namespace Database\Migrations;

use Core\Database\Migration;

class UserMigration extends Migration
{
    function __construct()
    {
        parent::__construct();
    }

    public function create()
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
            die();
        }
    }
}