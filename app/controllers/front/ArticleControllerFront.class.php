<?php

class ArticleControllerFront
{

    public function indexAction($params)
    {
        $url = $params[Routing::PARAMS_URL][1];
        $article = new Article();
        $article->populate(['url' => $url]);
        if ($article->id() == null || $article->publish() != 1 || $article->visibility() != 1) {
            Helpers::error404();
        }
        // echo $article->id();
        $article->getCategory();
        // echo $article->categories()->id();
        $article->getUser();
        // echo $article->user()->id();
        //$article->getSurvey();
        // echo $article->survey()->id();

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
