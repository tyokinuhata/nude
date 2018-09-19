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
        } catch(\PDOException $e) {
            echo $e->getMessage();
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
     * テーブルの作成
     */
    abstract public function create();

    /**
     * テーブル全削除
     */
    public function delete()
    {
        try {
            $file = new \SplFileObject($this->databaseSource, 'wb');
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }

        $res = $file->fwrite('');
        if ($res === false) {
            echo "Couldn't save this file.";
        }
    }
}