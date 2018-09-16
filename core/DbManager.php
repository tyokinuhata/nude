<?php

class DbManager
{
    protected $connections = [];
    protected $repositoryConnectionMap = [];
    protected $repositories = [];

    public function connect($name, $params)
    {
        $params = array_merge([
            'dsn' => null,
            'user' => '',
            'password' => '',
            'options' => []
        ], $params);

        $con = new PDO(
            $params['dsn'],
            $params['user'],
            $params['password'],
            $params['options']
        );

        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->connections[$name] = $con;
    }

    public function getConnection($name = null)
    {
        if (is_null($name)) return current($this->connections);
        return $this->connections[$name];
    }

    public function getConnectionForRepository($repositoryName)
    {
        if (isset($this->repositoryConnectionMap[$repositoryName])) {
            $name = $this->repositoryConnectionMap[$repositoryName];
            $con = $this->getConnection($name);
        } else {
            $con = $this->getConnection();
        }

        return $con;
    }

    public function get($repositoryName)
    {
        if (!isset($this->repositories[$repositoryName])) {
            $repositoryClass = $repositoryName . 'Repository';
            $con = $this->getConnectionForRepository($repositoryName);
            $repository = new $repositoryClass($con);
            $this->repositories[$repositoryName] = $repository;
        }

        return $this->repositories[$repositoryName];
    }

    public function setRepository($repositoryName, $name)
    {
        $this->repositoryConnectionMap[$repositoryName] = $name;
    }

    public function __destruct()
    {
        foreach ($this->repositories as $repository) unset($repository);
        foreach ($this->connections as $con) unset($con);
    }
}