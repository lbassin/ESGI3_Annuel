<?php

class MediaControllerBack
{

    public function indexAction($params)
    {
        $view = new View('back', 'media/index', 'admin');

        $media = new Media();

        $configList = [];
        $configList['size'] = isset($params['get']['size']) ? $params['get']['size'] : 2;
        $configList['page'] = isset($params['get']['page']) ? $params['get']['page'] : 1;
        $configList['count'] = $media->countAll();

        $view->assign('media', $media);
        $view->assign('configList', $configList);
    }

    public function newAction(){
        $view = new View('back', 'media/new', 'admin');

        $media = new Media();
        $view->assign('media', $media);
    }

    public function saveAction($params) {
        $media = new Media();
        $media->validate($params);
        if (count(Session::getErrors()) > 0) {
            Helpers::redirectBack();
        }

        $params['post']['path'] = $media->upload($params['files']);
        $params['post']['type'] = 'image';
        $params['post']['extension'] = $media->getExensionFromFile($params['files']['image']['name']);

        $media->fill($params['post']);
        $media->setUser($_SESSION['id']);

        try {
            $media->save();
        } catch (Exception $ex) {
            Session::addError($ex->getMessage());
            Helpers::redirectBack();
        }

        Session::addSuccess('Media successfully saved');
        Helpers::redirect(Helpers::getAdminRoute('media'));
    }

    public function deleteAction() {

    }
}
