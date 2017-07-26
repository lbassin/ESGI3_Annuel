<?php

class CategoryControllerFront extends Front
{
    public function indexAction($params = [])
    {
        parent::indexAction($params);
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

            $this->view->setView('category');
            $this->view->assign('category', $category);
        } else {
            Helpers::error404();
        }
    }

    public function displayCategories()
    {
        $category = new Category();
        $categories = $category->getAll();
        if (!empty($categories)) {
            $this->view->setView('list_category');
            $this->view->assign('categories', $categories);
        } else {
            Helpers::error404();
        }
    }
}
