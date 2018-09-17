<?php

class View
{
    protected $baseDir;
    protected $defaults;
    protected $layoutVariables = [];

    public function __construct($baseDir, $defaults = [])
    {
        $this->baseDir = $baseDir;
        $this->defaults = $defaults;
    }

    public function setLayoutVar($name, $value)
    {
        $this->layoutVariables[$name] = $value;
    }

    public function render($path, $variables = [], $layout = false)
    {
        $file = $this->baseDir . '/' . $path . '.php';

        extract(array_merge($this->defaults, $variables));

        ob_start();
        ob_implicit_flush(0);

        require $file;

        $content = ob_get_clean();

        if ($layout) {
            $content = $this->render($layout, array_merge($this->layoutVariables, [ 'content' => $content ]));
        }

        return $content;
    }

    public function escape($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}