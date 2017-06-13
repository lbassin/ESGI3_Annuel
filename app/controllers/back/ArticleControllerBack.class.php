<?php

class ArticleControllerBack
{

    public function indexAction()
    {
        $view = new View('back', 'article/index', 'admin');

        $article = new Article();

        $view->assign('article', $article);
    }

    public function viewAction() {

    }

    public function newAction(){
        $view = new View('back', 'article/new', 'admin');

        $article = new Article();
        $view->assign('article', $article);
    }

    public function saveAction($params) {
        $postData = $params['post'];
        $article = new Article();

        $article->validate($postData);

        if (count(Session::getErrors()) > 0) {
            Helpers::redirectBack();
        }

        if (!isset($postData['publish'])) {
            $postData['publish'] = 0;
        }

        if (!isset($postData['visibility'])) {
            $postData['visibility'] = 0;
        }

        $article->setSurvey($postData['survey']);
        $article->fill($postData);
        $article->setUser(1);

        $article->save();

        Session::addSuccess("Votre article a bien été enregistré");
        Helpers::redirect(Helpers::getAdminRoute('article/'));
    }

    public function editAction($params) {
        $params = $params['url'];

        if (!isset($params[0])) {
            Session::addError("Missing id");
            Helpers::redirectBack();
        }

        $articleId = $params[0];

        $view = new View('back', 'article/edit', 'admin');

        $article = new Article();
        $article->populate(["id" => $articleId]);

        if ($article->getId() == null) {
            Session::addError('Article ' . $articleId . ' not found');
            Helpers::redirectBack();
        }
        $view->assign('article', $article);
    }

    public function deleteAction() {

    }
}
