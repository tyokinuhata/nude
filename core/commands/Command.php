<?php

namespace Core\Commands;

abstract class Command
{
    public function __construct($method, $options)
    {
        $this->run($method, $options);
    }

    abstract public function run($method, $options);
}