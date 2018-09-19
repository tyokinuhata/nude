<?php

require __DIR__ . '/../vendor/autoload.php';

$user = new Database\Migrations\UserMigration();
$user->create();
$user->close();