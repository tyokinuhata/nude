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
    protected $authActions = [];

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

        if ($this->needsAuthentication($action) && !$this->session->isAuthenticated()) throw new UnauthorizedActionException();

        $content = $this->$actionMethod($params);

        return $content;
    }

    protected function render($variables = [], $template = null, $layout = 'layout')
    {
        $defaults = [
            'request' => $this->request,
            'baseUrl' => $this->request->getBaseUrl(),
            'session' => $this->session,
        ];

        $view = new View($this->application->getViewDir(), $defaults);

        if (is_null($template)) $template = $this->actionName;

        $path = $this->controllerName . '/' . $template;

        return $view->render($path, $variables, $layout);
    }

    protected function forward404()
    {
        throw new HttpNotFoundException('Forwarded 404 page from ' . $this->controllerName . '/' . $this->actionName);
    }

    protected function redirect($url)
    {
        if (!preg_match('#https?://#', $url)) {
            $protocol = $this->request->isSsl() ? 'https://' : 'http://';
            $host = $this->request->getHost();
            $baseUrl = $this->request->getBaseUrl();

            $url = $protocol . $host . $baseUrl . $url;
        }

        $this->response->setStatusCode(302, 'Found');
        $this->response->setHttpHeader('Location', $url);
    }

    protected function generateCsrfToken($formName)
    {
        $key = 'csrf_tokens/' . $formName;
        $tokens = $this->session->get($key, []);
        if (count($tokens) >= 10) array_shift($tokens);

        $token = hash('sha1', $formName . session_id() . microtime());
        $tokens = $token;

        $this->session->set($key, $tokens);

        return $token;
    }

    protected function checkCsrfToken($formName, $token)
    {
        $key = 'csrf_tokens/' . $formName;
        $tokens = $this->session->get($key, []);

        if (($pos = array_search($token, $tokens, true)) !== false) {
            unset($tokens[$pos]);
            $this->session->set($key, $tokens);

            return true;
        }
        return false;
    }

    protected function needsAuthentication($action)
    {
        if ($this->authActions === true || (is_array($this->authActions) && in_array($action, $this->authActions))) return true;
        return false;
    }
}