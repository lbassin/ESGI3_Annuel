<?php

class IndexControllerBack
{

    public function indexAction($params)
    {
        $view = new View('back', 'index', 'admin');
    }
}
