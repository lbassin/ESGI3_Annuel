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
        if (isset($params[Routing::PARAMS_URL][1])) {
            $article->populate(['id' => $params[Routing::PARAMS_URL][1]]);
        }
        $article->template_id($id);

        $data = [
            'title' => $article->title(),
            'description' => $article->description(),
            'url' => $article->url(),
            'publish' => $article->publish(),
            'content' => json_encode($article->content())
        ];

        Session::setFormData($data);

        $config = $article->getTemplateFormConfig();

        $view = new View('back', 'ajax/index', 'ajax');
        $view->includeModal('form', $config);
    }

    public function saveAction($params = [])
    {
        $postData = $params[Routing::PARAMS_POST];

        $content = [];
        foreach ($postData as $key => $value) {
            if (in_array($key, ['id', 'token', 'title', 'description', 'url', 'publish', 'template_id'])) {
                continue;
            }

            $content[$key] = $value;
            unset($postData[$key]);
        }
        $postData['content'] = serialize($content);
        $postData['user'] = Session::getUserId();
        $params[Routing::PARAMS_POST] = $postData;
        parent::saveAction($params);
    }

}
