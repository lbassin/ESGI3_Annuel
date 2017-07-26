<?php

class ArticleControllerFront extends Front
{

    public function indexAction($params = [])
    {
        parent::indexAction($params);
        $url = $params[Routing::PARAMS_URL];
        if (isset($url[1])) {
            $this->displayArticle($url[1]);
        } else if (isset($url[0])) {
            $this->displayArticles();
        } else {
            Helpers::error404();
        }
    }

    public function displayArticle($url)
    {
        $article = new Article();
        $article->populate(['url' => $url, 'publish' => 1]);
        if ($article->id() != null) {
            $article->getCategory();
            $article->getUser();
            $this->view->setView('article');
            $this->view->assign('article', $article);
        } else {
            Helpers::error404();
        }
    }

    public function displayArticles()
    {
        $article = new Article();
        $articles = $article->getAll(['publish' => 1], ['limit' => 9], ['updated_at' => 'DESC', 'created_at' => 'DESC']);
        if (!empty($articles)) {
            $this->view->setView('list_article');
            $this->view->assign('articles', $articles);
        }
    }

    public function commentAction($params)
    {
        $postData = $params[Routing::PARAMS_POST];
        $comment = new Comment();
        $comment->content($postData['content']);
        $comment->user = new User(['id' => $_SESSION['id']]);
        $comment->article = new article(['id' => $postData['id_article']]);
        $comment->save();

        // TODO : post comment
    }

    public function reportAction($params)
    {

        // TODO : report comment
    }
}
