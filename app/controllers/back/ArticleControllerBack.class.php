<?php

class ArticleControllerBack extends Controller
{

    public function templatesAction()
    {
        $article = new Article();
        $templates = $article->getTemplates();

        echo json_encode($templates);
    }

    public function formAction($params)
    {
        if (!isset($params[Routing::PARAMS_URL][0])) {
            echo json_encode(['error' => true]);
            die;
        }
        $id = $params[Routing::PARAMS_URL][0];

        $article = new Article();
        $article->setTemplateId($id);

        $config = $article->getTemplateFormConfig();

        $view = new View('back', 'ajax/index', 'ajax');
        $view->includeModal('form', $config);
    }

}
