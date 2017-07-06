<?php

/**
 * Class PageControllerBack
 */
class PageControllerBack
{

    /**
     * @param $params
     */
    public function indexAction($params)
    {
        $view = new View('back', 'page/index', 'admin');

        $page = new Page();
        $view->assign('page', $page);
    }

    public function viewAction()
    {

    }

    /**
     * @param $params
     */
    public function newAction($params)
    {
        $view = new View('back', 'page/new', 'admin');
        $view->assign('page', new Page);
    }

    /**
     * @param $params
     */
    public function addAction($params)
    {
        if (!isset($params[Routing::PARAMS_POST])) {
            $params[Routing::PARAMS_POST] = [];
        }
        $data = $params[Routing::PARAMS_POST];

        $validator = new Validator();
        $errors = $validator->validate($data, $this->getPageConstraints());

        foreach ($data['components'] as $component){
            Helpers::debug(gettype($component));
            Helpers::debug($component);
            $componentData = json_decode($component, true);
            Helpers::debug($componentData);
            Helpers::debug(json_last_error_msg());
            Helpers::debug('# ---- #');
        }

//        Helpers::debug(json_decode('{"title":"test",\"template_id\":\"1\"}', true));

        Helpers::debug($errors);
        Helpers::debug($params);
        die;
    }

    public function editAction()
    {

    }

    public function deleteAction()
    {

    }

    /**
     * @return array
     */
    private function getPageConstraints()
    {
        return [
            'title' => [
                'required' => 1,
                'min' => 4
            ],
            'url' => [
                'unique' => 1,
                'require' => 1,
                'min' => 3
            ],
            'meta_desc' => [
                'min' => 5
            ]
        ];
    }
}
