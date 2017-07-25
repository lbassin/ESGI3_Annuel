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

}
