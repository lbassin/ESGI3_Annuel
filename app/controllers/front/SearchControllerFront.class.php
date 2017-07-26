<?php

class SearchControllerFront extends Front
{
    public function indexAction($params = [])
    {
        parent::indexAction($params);
        $this->view->setView('search');
        if (isset($params[Routing::PARAMS_GET])) {
            if (array_key_exists('search', $params[Routing::PARAMS_GET])) {
                $search = $params[Routing::PARAMS_GET]['search'];
                $article = new Article();
                $articles = $article->getAll(['search' => $search]);
                $page = new Page();
                $pages = $page->getAll(['search' => $search]);
                $this->view->assign('search', $search);
                $this->view->assign('articles', $articles);
                $this->view->assign('pages', $pages);
            }
        }
    }
}