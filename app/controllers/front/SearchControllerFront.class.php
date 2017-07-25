<?php

class SearchControllerFront
{
    public function indexAction($params)
    {
        $view = new View('front', 'search');
        if (isset($params[Routing::PARAMS_GET])) {
            if (array_key_exists('search', $params[Routing::PARAMS_GET])) {
                $search = $params[Routing::PARAMS_GET]['search'];
                $article = new Article();
                $articles = $article->getAll(['search' => $search]);
                $page = new Page();
                $pages = $page->getAll(['search' => $search]);
                $view->assign('search', $search);
                $view->assign('articles', $articles);
                $view->assign('pages', $pages);
            }
        }
    }
}