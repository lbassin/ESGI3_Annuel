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
        $article->setTemplateId($id);

        $data = [
            'title' => $article->getTitle(),
            'description' => $article->getDescription(),
            'url' => $article->getUrl(),
            'publish' => $article->getPublish(),
            'content' => json_encode($article->getContent())
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
            if (in_array($key, ['id', 'token', 'title', 'description', 'url', 'publish', 'templateId'])) {
                continue;
            }

            $content[$key] = $value;
            unset($postData[$key]);
        }
        $postData['content'] = serialize($content);
        $postData['idUser'] = Session::getUserId();
        if ($postData['url']) {
            if (!empty($postData['url'])) {
                $postData['url'] = Helpers::slugify($postData['url']);
            }
        }

        $params[Routing::PARAMS_POST] = $postData;
        parent::saveAction($params);
    }

}
