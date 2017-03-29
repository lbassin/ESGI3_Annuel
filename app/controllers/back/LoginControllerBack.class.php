<?php

class LoginControllerBack
{

    public function indexAction($params)
    {
        $view = new View('back', 'index', 'login');
    }
}
