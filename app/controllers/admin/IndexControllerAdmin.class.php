<?php

class IndexControllerAdmin
{

    public function indexAction($params)
    {
        $view = new View('back', 'index', 'admin');
    }
}
