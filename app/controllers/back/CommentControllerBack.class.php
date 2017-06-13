<?php

class CommentControllerBack
{

    public function indexAction()
    {
        $view = new View('back', 'comment/index', 'admin');

        $comment = new Comment();

        $view->assign('comment', $comment);
    }

    public function viewAction() {

    }

    public function newAction(){
        $view = new View('back', 'comment/new', 'admin');

        $comment = new Comment();
        $view->assign('comment', $comment);
    }

    public function editAction($params) {
        $params = $params['url'];
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
        $postData = $params['post'];

        $comment->fill($postData);
        $comment->setArticle($postData['article']);
        $comment->setUser($postData['article']);

        $comment->save();

        Session::addSuccess("Votre comment a bien été enregistré");
        Helpers::redirect(Helpers::getAdminRoute('comment/'));
    }

    public function deleteAction() {

    }
}
