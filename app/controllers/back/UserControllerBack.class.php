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

    public function saveAction($params)
    {
        $user = new User();
        $errors = $user->validate($params);

        if (count($errors) > 0) {
            // Add errors to view
            // Redirect back
            die('error');
        }

        $user->fill($params);
        $user->setRole($params['role']);

        try {
            $user->save();
        } catch (Exception $ex) {
            Session::addError($ex->getMessage());
            Helpers::redirectBack();
        }

        Session::addSuccess('User successfully saved');
        Helpers::redirect(Helpers::getAdminRoute('user'));
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

        if ($user->getId() == null) {
            Session::addError('User ' . $userId . ' not found');
            Helpers::redirectBack();
        }

        $view->assign('user', $user);
    }

    public function deleteAction(){

    }
}
