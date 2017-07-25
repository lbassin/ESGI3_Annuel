<?php

class IndexControllerBack
{
    public function indexAction()
    {
        $view = new View('back', 'dashboard/index', 'admin');

        $view->assign('pseudo', 'test');
    }
}
