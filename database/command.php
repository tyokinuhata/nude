<?php

require __DIR__ . '/../vendor/autoload.php';

$user = new Database\UserMigration();
$user->create();
$user->close();