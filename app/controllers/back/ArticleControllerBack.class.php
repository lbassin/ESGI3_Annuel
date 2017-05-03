<?php

class ArticleControllerBack
{

    public function indexAction()
    {
        $view = new View('back', 'article/index', 'admin');
        $article = new Article();
        $view->assign('article', $article);
    }

    public function viewAction(){

    }

    public function newAction(){
        $view = new View('back', 'article/new', 'admin');

        $article = new Article();
        $view->assign('article', $article);
    }

    public function editAction(){

    }

    public function saveAction($params) {
        $article = new Article();

        $article->validate($params);

        if (count(Session::getErrors()) > 0) {
            Helpers::redirectBack();
        }

        if (!isset($params['publish'])) {
            $params['publish'] = 0;
        }

        if (!isset($params['visibility'])) {
            $params['visibility'] = 0;
        }

        $article->fill($params);
        $article->save();
    }

    public function deleteAction() {

    }
}
