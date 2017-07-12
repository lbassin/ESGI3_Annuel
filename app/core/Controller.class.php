<?php

abstract class Controller implements Controllable
{
    use Csrfable;
    const CLASS_CONTROLLER = 'ControllerBack';
    private $className;
    private $configList = [];

    function __construct()
    {
        $this->className = str_replace(self::CLASS_CONTROLLER, '', get_called_class());
    }

    public function indexAction($params = [])
    {
        $view = new View('back', lcfirst($this->className) . '/index', 'admin');

        $class = new $this->className;
        $this->configList['size'] = isset($params[Routing::PARAMS_GET]['size']) ? $params[Routing::PARAMS_GET]['size'] : 10;
        $this->configList['page'] = isset($params[Routing::PARAMS_GET]['page']) ? $params[Routing::PARAMS_GET]['page'] : 1;
        $this->configList['availableSize'] = [10, 20, 50];
        $this->configList['count'] = $class->countAll();

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

        if ($class->getId() == null) {
            Session::addError($this->className . ' ' . $classId . ' not found');
            Helpers::redirectBack();
        }
        $view->assign(lcfirst($this->className), $class);
    }

    public function saveAction($params = [], $multiple = false) {
        $class = new $this->className();
        $postData = $params[Routing::PARAMS_POST];
        if ($multiple == true && $multiple != -1) {
            $this->check((isset($postData['token'])) ? $postData['token'] : '');
        }
        $validator = new Validator($postData, $this->className);
        $validator->validate($class->validate());

        if (count(Session::getErrors()) > 0) {
            Session::setFormData($postData);
            Helpers::redirectBack();
        }

        $class->fill($postData);

        foreach ($class->getForeignValues() as $table) {
            $setterName = 'set' . ucfirst($table);
            $class->$setterName($postData[$table]);
        }

        $class->save();

        if (!$multiple) {
            Session::addSuccess("Votre " . lcfirst($this->className) . " a bien été enregistré");
            if (isset($params[Routing::PARAMS_GET]['redirectToEdit'])) {
                Helpers::redirect(Helpers::getAdminRoute(lcfirst($this->className) . '/edit/' . $class->getId()));
            } else {
                Helpers::redirect(Helpers::getAdminRoute(lcfirst($this->className)));
            }
        }
        return $class->getId();
    }

    public function deleteAction($params = [])
    {
        $postData = $params[Routing::PARAMS_POST];
        $this->check(isset($postData['token']) ? $postData['token'] : '');

        $params = explode(',', $postData['id']);
        foreach ($params as $key => $value) {
            $class = new $this->className();
            $class->setId($value);

            try {
                $class->delete();
            } catch (Exception $ex) {
                Session::addError($ex->getMessage());
                Helpers::redirectBack();
            }
        }
        Session::addSuccess($this->className . ' successfully deleted');
        Helpers::redirect(Helpers::getAdminRoute($this->className));
    }
}