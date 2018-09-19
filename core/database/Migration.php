<?php

namespace Core\Database;

abstract class Migration
{
    protected $databaseSource = __DIR__ . '/../../database/database.sqlite';
    protected $databaseHandle;

    /**
     * Migration constructor.
     */
    function __construct()
    {
        $this->connect();
    }

    /**
     * SQLiteへ接続
     */
    public function connect()
    {
        try {
            $this->databaseHandle = new \PDO('sqlite:' . $this->databaseSource);
            $this->databaseHandle->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            echo $e->getMessage();
            echo $e->getTraceAsString();
            die();
        }
    }

    /**
     * SQLiteから切断
     */
    public function close()
    {
        $this->databaseHandle = null;
    }

    /**
     * マイグレーション実行時
     */
    abstract public function up();

    /**
     * マイグレーションを元に戻す
     */
    abstract public function down();
}