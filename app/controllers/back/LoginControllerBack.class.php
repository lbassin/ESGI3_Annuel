<?php

class LoginControllerBack
{

    public function indexAction($params)
    {
        $view = new View('back', 'index', 'login');
    }

    public function logoutAction()
    {
        session_unset();
        session_destroy();
        $view = new View('back', 'index', 'login');
    }
}
