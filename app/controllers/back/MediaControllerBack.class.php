<?php

class MediaControllerBack
{

    public function indexAction()
    {
        $view = new View('back', 'media/index', 'admin');

        $media = new Media();

        $view->assign('media', $media);
    }

    public function viewAction() {

    }

    public function newAction(){

    }

    public function editAction($params) {

    }

    public function saveAction($params) {
        
    }

    public function deleteAction() {

    }
}
