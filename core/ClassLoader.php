<?php

class ClassLoader
{
    protected $directories;

    public function register()
    {
        spl_autoload_register([ $this, 'load' ]);
    }

    public function setDirectory($directory)
    {
        $this->directories[] = $directory;
    }

    public function load($class)
    {
        foreach ($this->directories as $directory) {
            $file = $directory . '/' . $class . '.php';
            if (is_readable($file)) {
                require $file;
                break;
            }
        }
    }
}