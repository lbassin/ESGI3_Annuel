<?php

class Routing
{
    const PARAMS_URL = 'url';
    const PARAMS_POST = 'post';
    const PARAMS_GET = 'get';
    const PARAMS_FILE = 'files';

    /** @var array uriExploded */
    private $uriExploded;
    /** @var string controllerArea */
    private $controllerArea;
    /** @var string controllerName */
    private $controllerName;
    /** @var string actionName */
    private $actionName;
    /** @var array params */
    private $params = [];
    /** @var array $getData */
    private $getData = [];

    public function __construct()
    {
        $uri = $_SERVER["REQUEST_URI"];
        $uri = preg_replace("#" . BASE_PATH_PATTERN . "#i", "", $uri, 1);

        $uriExplodedParams = explode('?', $uri);
        if (isset($uriExplodedParams[1])) {
            $this->setGetData($uriExplodedParams[1]);
        }

        $uri = $uriExplodedParams[0];
        $uri = trim($uri, "/");

        $this->uriExploded = explode("/", $uri);

        if ($this->checkBackOffice()) {
            if (!Session::isLogged() && !in_array('login', $this->uriExploded)) {
                $this->page404();
            }
            $this->handleAdmin();
        } else {
            $this->handleFront();
        }

        $this->setController();
        $this->setAction();
        $this->setParams();

        $this->runRoute();
    }

    private function setGetData($data)
    {
        parse_str($data, $this->getData);
    }

    /**
     * @return bool
     */
    public function checkBackOffice()
    {
        if (!isset($this->uriExploded[0])) {
            return false;
        }

        return ($this->uriExploded[0] === ADMIN_PATH);
    }

    public function page404()
    {
        header('HTTP/1.1 404 Not Found');
        die("Error 404");
        // TODO
    }

    public function handleAdmin()
    {
        $this->controllerArea = 'back';

        unset($this->uriExploded[0]);
        $this->uriExploded = array_values($this->uriExploded);
    }

    public function handleFront()
    {
        $this->controllerArea = 'front';
    }

    public function setController()
    {
        if (isset($this->uriExploded[0])) {
            $requested = $this->uriExploded[0];
        }

        $controller = (empty($requested)) ? "Index" : ucfirst($requested);
        $this->controllerName = $controller . "Controller" . ucfirst($this->controllerArea);

        unset($this->uriExploded[0]);
    }

    public function setAction()
    {
        if (isset($this->uriExploded[1])) {
            $requested = $this->uriExploded[1];
        }

        $action = (empty($requested)) ? "index" : $requested;
        $this->actionName = $action . "Action";

        unset($this->uriExploded[1]);
    }

    public function setParams()
    {
        $this->params = [];

        $jsonPost = file_get_contents('php://input');
        $jsonData = json_decode($jsonPost, true);
        if (!is_array($jsonData)) {
            $jsonData = [];
        }

        $this->params[self::PARAMS_POST] = array_merge($_POST, $jsonData);
        $this->params[self::PARAMS_URL] = array_values($this->uriExploded);
        $this->params[self::PARAMS_GET] = $this->getData;
        $this->params[self::PARAMS_FILE] = $_FILES;
    }

    public function runRoute()
    {
        if ($this->checkRoute()) {
            $controller = new $this->controllerName();
            $controller->{$this->actionName}($this->params);
        } else {
            $this->page404();
        }
    }

    /**
     * @return bool
     */
    public function checkRoute()
    {
        $controllerPath = "app/controllers/" . $this->controllerArea . '/' . $this->controllerName . ".class.php";
        if (!file_exists($controllerPath)) {
            echo '1';
            return false;
        }
        include $controllerPath;

        if (!class_exists($this->controllerName)) {
            echo '2';
            return false;
        }

        if (!method_exists($this->controllerName, $this->actionName)) {
            echo $this->actionName;
            return false;
        }

        return true;
    }

    public function isInstalled()
    {
        return false; // TODO
    }

    public function isSetupRoute()
    {
        return ($this->controllerName == 'SetupControllerBack');
    }

    public function runSetup()
    {
        $setupPath = Helpers::getAdminRoute('setup');
        Helpers::redirect($setupPath);
    }

}
