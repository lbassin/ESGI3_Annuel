<?php

class CommentControllerBack
{

    public function indexAction()
    {
        $view = new View('back', 'comment/index', 'admin');

        $comment = new Comment();

        $configList = [];
        $configList['size'] = isset($params['get']['size']) ? $params['get']['size'] : 2;
        $configList['page'] = isset($params['get']['page']) ? $params['get']['page'] : 1;
        $configList['count'] = $comment->countAll();

        $view->assign('comment', $comment);
        $view->assign('configList', $configList);
    }

    public function viewAction() {

    }

    public function newAction(){
        $view = new View('back', 'comment/new', 'admin');

        $comment = new Comment();
        $view->assign('comment', $comment);
    }

    public function editAction($params) {
        $params = $params[PARAMS_URL];
        if (!isset($params[0])) {
            Session::addError("Missing id");
            Helpers::redirectBack();
        }
        $view = new View('back', 'comment/edit', 'admin');
        $commentId = $params[0];
        $comment = new Comment();
        $comment->populate(["id" => $commentId]);

        if ($comment->getId() == null) {
            Session::addError('comment ' . $commentId . ' not found');
            Helpers::redirectBack();
        }
        $view->assign('comment', $comment);
    }

    public function saveAction($params) {
        $comment = new Comment();

        $comment->validate($params);

        if (count(Session::getErrors()) > 0) {
            Helpers::redirectBack();
        }
        $postData = $params[PARAMS_POST];

        $comment->fill($postData);
        $comment->setArticle($postData['article']);
        $comment->setUser($postData['article']);

        $comment->save();

        Session::addSuccess("Votre comment a bien été enregistré");
        Helpers::redirect(Helpers::getAdminRoute('comment/'));
    }

    public function deleteAction($params = []) {
        $params['post']['id'] = [1];
        $ids = $params['post']['id'];
        foreach ($ids as $key => $id) {
            $comment = new Comment();
            $comment->setId($id);
            try {
                $comment->delete();
            } catch (Exception $ex) {
                Session::addError($ex->getMessage());
                Helpers::redirectBack();
            }
        }
        Session::addSuccess('Comments successfully deleted');
        Helpers::redirect(Helpers::getAdminRoute('comment'));
    }
}
