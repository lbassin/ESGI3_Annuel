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

    public function deleteAction(){

    }
}
