<?php

namespace Core\Commands;

abstract class Command
{
    protected $name = '';
    protected $description = '';

    public function __construct()
    {
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    abstract public function run();
}