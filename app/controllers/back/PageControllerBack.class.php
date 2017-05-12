<?php

class PageControllerBack
{

    public function indexAction($params)
    {
        $view = new View('back', 'page/index', 'admin');

        $page = new Page();
        $view->assign('page', $page);
    }

    public function viewAction(){

    }

    public function newAction(){
        $view = new View('back', 'page/new', 'admin');

        $page = new Page();
        $view->assign('page', $page);
    }

    public function editAction(){

    }

    public function deleteAction(){

    }
}
