<?php

abstract class Controller implements Controllable
{
    use Csrfable;
    const CLASS_CONTROLLER = 'ControllerBack';
    protected $className;
    private $configList = [];

    function __construct()
    {
        $this->className = str_replace(self::CLASS_CONTROLLER, '', get_called_class());
    }

    public function indexAction($params = [])
    {
        $view = new View('back', lcfirst($this->className) . '/index', 'admin');

        $class = new $this->className;
        $this->configList['search'] = (isset($params[Routing::PARAMS_GET]['search']) && !empty($params[Routing::PARAMS_GET]['search'])) ? $params[Routing::PARAMS_GET]['search'] : null;
        $this->configList['size'] = isset($params[Routing::PARAMS_GET]['size']) ? $params[Routing::PARAMS_GET]['size'] : 10;
        $this->configList['page'] = isset($params[Routing::PARAMS_GET]['page']) ? $params[Routing::PARAMS_GET]['page'] : 1;
        $this->configList['availableSize'] = [10, 20, 50];
        $this->configList['count'] = $class->count();
        $view->assign(lcfirst($this->className), $class);
        $view->assign('configList', $this->configList);
    }

    public function newAction($params = [])
    {
        Csrf::generate();
        $view = new View('back', lcfirst($this->className) . '/new', 'admin');

        $class = new $this->className;
        $view->assign(lcfirst($this->className), $class);
        if (!empty($params)) {
            $view->assign('params', $params);
        }
    }

    public function editAction($params = [])
    {
        Csrf::generate();
        $classId = $params[Routing::PARAMS_URL][0];
        if (!isset($classId)) {
            Session::addError("Missing id");
            Helpers::redirectBack();
        }

        $view = new View('back', lcfirst($this->className) . '/edit', 'admin');

        $class = new $this->className();
        $class->populate(["id" => $classId]);

        if ($class->id() == null) {
            Session::addError($this->className . ' ' . $classId . ' not found');
            Helpers::redirectBack();
        }
        $view->assign(lcfirst($this->className), $class);
    }

    public function saveAction($params = [], $multiple = false, $table = false)
    {
        if ($table != false) {
            $this->className = $table;
        }

        $postData = $params[Routing::PARAMS_POST];

        foreach ($postData as $name => $value) {
            if (substr($name, 0, 5) === "path_") {
                $postData[$name] = $this->saveUploadedFile($name, $value);
            } else if (unserialize($value)) {
                $data = unserialize($value);
                foreach ($data as $name2 => $value2){
                    if (substr($name2, 0, 5) === "path_") {
                        $data[$name2] = $this->saveUploadedFile($name2, $value2);
                    }
                }
                $postData[$name] = serialize($data);
            }
        }

        $class = new $this->className($postData);
        foreach ($class->getBelongsTo() as $table) {
            $className = ucwords($table, '_');
            $class->$table = new $className(['id' => $postData[$table]]);
        }

        if ($multiple == true && $multiple != -1) {
            $this->check((isset($postData['token'])) ? $postData['token'] : '');
        }

        $validator = new Validator($postData, $this->className);
        $validator->validate($class->validate());

        if (count(Session::getErrors()) > 0) {
            Session::setFormData($postData);
            Helpers::redirectBack();
        }

        $class->save();

        if (!$multiple) {
            Session::addSuccess("Votre " . lcfirst(str_replace(self::CLASS_CONTROLLER, '', get_called_class())) . " a bien été enregistré");
            if (isset($params[Routing::PARAMS_GET]['redirectToEdit'])) {
                Helpers::redirectBack();
            } else {
                Helpers::redirect(Helpers::getAdminRoute(lcfirst(str_replace(self::CLASS_CONTROLLER, '', get_called_class()))));
            }
        }
        return $class->id();
    }

    public function deleteAction($params = [])
    {
        $postData = $params[Routing::PARAMS_POST];
        $class = new $this->className();
        if (is_array($postData)) {
            if (isset($postData['id'])) {
                $class->delete(['id' => $postData['id']]);
                Helpers::redirect(Helpers::getAdminRoute(lcfirst($this->className)));
            } else {
                foreach ($postData as $id) {
                    $class->delete(['id' => $id]);
                }
            }
        }
    }

    private function saveUploadedFile($name, $value)
    {
        $nameId = uniqid();
        $extension = pathinfo($value)['extension'];
        rename($value, FILE_UPLOAD_PATH . "/" . $nameId . "." . $extension);

        return FILE_UPLOAD_PATH . "/" . $nameId . "." . $extension;
    }
}