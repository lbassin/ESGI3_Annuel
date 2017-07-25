<?php

class CategoryControllerFront
{
    public function indexAction($params)
    {
        $url = $params[Routing::PARAMS_URL];
        $category = new Category();
        if (!isset($url[1])) {
            $category->populate($url[1]);
            $category->getArticle();
        } else {
            $categories = $category->getAll();
        }
    }
}
