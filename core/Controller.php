<?php

abstract class Controller
{
    protected $controllerName;
    protected $actionName;
    protected $application;
    protected $request;
    protected $response;
    protected $session;
    protected $dbManager;

    public function __construct($application)
    {
        $this->controllerName = strtolower(substr(get_class($this), 0, -10));

        $this->application = $application;
        $this->request = $application->getRequest();
        $this->response = $application->getResponse();
        $this->session = $application->getSession();
        $this->dbManager = $application->getDbManager();
    }

    public function run($action, $params = [])
    {
        $this->actionName = $action;

        $actionMethod = $action . 'Action';
        if (!method_exists($this, $actionMethod)) $this->forward404();

        $content = $this->$actionMethod($params);

        return $content;
    }


}