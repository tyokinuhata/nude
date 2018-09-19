<?php

namespace Core\Database;

abstract class Migration
{
    protected $fileName;
    protected $sqlite;

    /**
     * CreateDatabase constructor.
     * @param string $fileName
     * DBにするファイル名の指定
     */
    function __construct($fileName)
    {
        $this->fileName = $fileName;
        $this->connect();
    }

    /**
     * SQLiteへ接続
     */
    public function connect()
    {
        try {
            $this->sqlite = new \PDO("sqlite:{$this->fileName}");
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
        $this->sqlite = null;
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
            $file = new \SplFileObject($this->fileName, 'wb');
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