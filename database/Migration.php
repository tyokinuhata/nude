<?php

class Migration
{
    private $fileName;
    private $sqlite;

    /**
     * CreateDatabase constructor.
     * @param string $fileName
     * DBにするファイル名の指定
     */
    function __construct($fileName = 'database.sqlite')
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
            $this->sqlite = new PDO("sqlite:{$this->fileName}");
        } catch(PDOException $e) {
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
    public function create()
    {
        $sql = 'CREATE TABLE `post` (
            `id` INTEGER PRIMARY KEY,
            `name` TEXT,
            `comment` TEXT,
            `created_at` TEXT
	    )';

        try {
            $this->sqlite->exec($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    /**
     * テーブル全削除
     */
    public function clear()
    {
        try {
            $file = new SplFileObject($this->fileName, 'wb');
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }

        $res = $file->fwrite('');
        if ($res === false) {
            echo "Couldn't save this file.";
        }
    }
}

$migration = new Migration();
$migration->create();
//$migration->clear();
$migration->close();