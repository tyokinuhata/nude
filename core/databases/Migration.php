<?php

namespace Core\Databases;

abstract class Migration
{
    protected $databaseSource = __DIR__ . '/../../databases/database.sqlite';
    protected $databaseHandle;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * デストラクタ
     */
    public function __destruct()
    {
        $this->close();
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