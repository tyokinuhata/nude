<?php

require_once 'core/ClassLoader.php';

$classLoader = new ClassLoader();
$classLoader->setDirectory(__DIR__ . '/core');
$classLoader->setDirectory(__DIR__ . '/models');
$classLoader->register();