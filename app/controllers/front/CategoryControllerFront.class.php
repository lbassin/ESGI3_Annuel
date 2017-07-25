<?php

class CategoryControllerFront
{
    public function indexAction($params)
    {
        $url = $params[Routing::PARAMS_URL];
        if (isset($url[1])) {
            $this->displayArticles($url[1]);
        } else if (isset($url[0])) {
            $this->displayCategories();
        } else {
            Helpers::error404();
        }
    }

    public function displayArticles($slug)
    {
        $category = new Category();
        $category->populate(['url' => $slug]);
        if ($category->id() != null) {
            $category->getArticle();
            $view = new View('front', 'category');
            $view->assign('category', $category);
        } else {
            Helpers::error404();
        }
    }

    public function displayCategories()
    {
        $category = new Category();
        $categories = $category->getAll();
        if (!empty($categories)) {
            $view = new View('front', 'list_category');
            $view->assign('categories', $categories);
        } else {
            Helpers::error404();
        }
    }
}
