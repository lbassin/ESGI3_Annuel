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

        $xml = new Xml('themes/templates/default/pages/template01.xml');
        $xml->open();
    }

    public function editAction(){

    }

    public function deleteAction(){

    }
}
