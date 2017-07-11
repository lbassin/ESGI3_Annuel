<?php

class ArticleControllerBack extends Controller
{

    public function templatesAction()
    {
        $article = new Article();
        $templates = $article->getTemplates();

        echo json_encode($templates);
    }

    public function formAction()
    {
        echo json_encode(['todo']);
    }

}
