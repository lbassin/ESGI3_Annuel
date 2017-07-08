<?php

abstract class Controller implements Controllable
{
    const CLASS_CONTROLLER = 'ControllerBack';
    private $className;
    private $configList = [];

    function __construct()
    {
        $this->className = str_replace(self::CLASS_CONTROLLER, '', get_called_class());
    }

    public function indexAction()
    {
        $view = new View('back', lcfirst($this->className) . '/index', 'admin');

        $class = new $this->className;

        $this->configList['size'] = isset($params[Routing::PARAMS_GET]['size']) ? $params[Routing::PARAMS_GET]['size'] : 20;
        $this->configList['page'] = isset($params[Routing::PARAMS_GET]['page']) ? $params[Routing::PARAMS_GET]['page'] : 1;
        $this->configList['count'] = $class->countAll();

        $view->assign(lcfirst($this->className), $class);
        $view->assign('configList', $this->configList);
    }

    public function newAction()
    {
        $view = new View('back', lcfirst($this->className) . '/new', 'admin');

        $class = new $this->className;
        $view->assign(lcfirst($this->className), $class);
    }

    public function editAction($params = [])
    {
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

    public function saveAction($params = [])
    {
        $class = new $this->className();
        $postData = $params[Routing::PARAMS_POST];

        $validator = new Validator($postData, $this->className);
        $validator->validate($class->validate());

        if (count(Session::getErrors()) > 0) {
            Helpers::redirectBack();
        }

        $class->fill($postData);

        foreach ($class->getForeignValues() as $key => $table) {
            $setterName = 'set' . ucfirst($table);
            $class->$setterName($postData);
        }

        $class->save();

        Session::addSuccess("Votre " . lcfirst($this->className) . " a bien été enregistré");
        Helpers::redirect(Helpers::getAdminRoute(lcfirst($this->className) . '/'));
    }

    public function deleteAction($params = [])
    {
        $params = explode(',', $params[Routing::PARAMS_GET]['id']);
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
        Session::addSuccess($this->className . 'successfully deleted');
        Helpers::redirect(Helpers::getAdminRoute($this->className));
    }
}