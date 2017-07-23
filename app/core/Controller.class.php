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
        $class = new $this->className($postData);
        foreach ($class->getBelongsTo() as $table) {
            $class->$table = new $table(['id' => $postData[$table]]);
        }

        if (!empty($params[Routing::PARAMS_FILE])) {
            if (!$class->id()) {
                if (method_exists($class, 'upload')) {
                    $class->upload($params[Routing::PARAMS_FILE]);
                    $postData = $class->toArray();
                }
            }
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
        if (is_array($postData)) {
            foreach ($postData as $id) {
                self::deleteAction([Routing::PARAMS_POST => $id]);
            }
        }

        $class = new $this->className();

        try {
            $class->delete(['id' => $postData[0]]);
            echo json_encode(['success' => true, 'message' => 'successfully deleted']); // TODO : Error
        } catch (Exception $ex) {
            echo json_encode(['error' => true, 'message' => $ex->getMessage()]); // TODO : Error
        }
    }
}