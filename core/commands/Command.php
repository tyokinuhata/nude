<?php

namespace Core\Commands;

abstract class Command
{
    public function __construct($action, $options)
    {
        $this->run($action, $options);
    }

    abstract public function run();
}