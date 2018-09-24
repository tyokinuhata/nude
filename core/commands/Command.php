<?php

namespace Core\Commands;

abstract class Command
{
    public function __construct($method, $options)
    {
        $this->run();
    }

    abstract public function run();
}