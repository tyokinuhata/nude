<?php

namespace Core\Commands;

abstract class Command
{
    protected $name = '';
    protected $description = '';

    /**
     * @return string
     * コマンド名の取得
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     * コマンドの説明の取得
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     * コマンドの処理
     */
    abstract public function handle();
}