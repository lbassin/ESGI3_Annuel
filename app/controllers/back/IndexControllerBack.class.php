<?php

class IndexControllerBack
{
    public function indexAction()
    {
        $view = new View('back', 'dashboard/index', 'admin');

        $articles = new Article();
        $allArticles = $articles->getAll();

        $articleParJour = array();
        foreach($allArticles as $values)
        {
            $d = date("Y-m-d", strtotime($values->created_at()));
            $articleParJour[$d] += 1;
        }

        $articlePublished = array();
        foreach($allArticles as $values)
        {
            if ($values->publish()) {
                $articlePublished['non-publie'] += 1;
            } else {
                $articlePublished['publie'] += 1;
            }
        }

        $view->assign('nbArticleDate', $articleParJour);
        $view->assign('nbArticlePublie', $articlePublished);
    }
}
