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

    public function editAction($params)
    {
        if (!isset($params[0])) {
            die('Missing id');
        }
        $userId = $params[0];

        $view = new View('back', 'user/edit', 'admin');

        $user = new User();
        $user->populate(['id' => $userId]);

        if ($user->getId() < 0) {
            die('User not found');
        }

        $view->assign('user', $user);
    }

    public function deleteAction(){

    }
}
