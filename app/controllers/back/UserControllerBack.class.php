<?php

class UserControllerBack
{

    public function indexAction()
    {
        $view = new View('back', 'user/index', 'admin');

        $user = new User();
        $view->assign('user', $user);
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
