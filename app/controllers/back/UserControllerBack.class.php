<?php

class UserControllerBack
{

    public function indexAction($params)
    {
        Helpers::debug([__DIR__, __CLASS__, __FUNCTION__, $params]);
    }

    public function viewAction(){

    }

    public function newAction(){
        $view = new View('back', 'user/new', 'admin');

        $user = new User();
        $view->assign('user', $user);
    }

    public function editAction(){

    }

    public function deleteAction(){

    }
}
