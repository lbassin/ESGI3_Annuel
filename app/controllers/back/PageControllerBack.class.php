<?php

class PageControllerBack
{

    public function indexAction($params)
    {
        $view = new View('back', 'page/index', 'admin');

        $page = new Page();
        $view->assign('page', $page);
    }

    public function viewAction()
    {

    }

    public function newAction($params)
    {
        $view = new View('back', 'page/new', 'admin');
        $view->assign('page', new Page);
    }

    public function addAction($params)
    {
        Helpers::debug($params);
        die;
    }


    public function editAction()
    {

    }

    public function deleteAction()
    {

    }
}
