<?php

class ConfigControllerBack extends Controller
{
    public function indexAction($params = [])
    {
        Csrf::generate();

        $view = new View('back', lcfirst($this->className) . '/index', 'admin');

        $class = new $this->className();
        $class->populate(["id" => 1]);

        if ($class->id() == null) {
            Session::addError($this->className . ' ' . 1 . ' not found');
            Helpers::redirectBack();
        }
        $view->assign(lcfirst($this->className), $class);
    }
}