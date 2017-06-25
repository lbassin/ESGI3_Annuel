<?php

class PageControllerBack
{

    public function indexAction($params)
    {
        $view = new View('back', 'page/index', 'admin');

        $page = new Page();
        $view->assign('page', $page);
    }

    public function viewAction()
    {

    }

    public function newAction($params)
    {
        $view = new View('back', 'page/new', 'admin');
        $view->assign('page', new Page);
    }

    /**
     * @return array
     */
    private function getComponentTemplates()
    {
        $templates = [];
        $directoryPath = 'themes/templates/default/components/'; // TODO : Change to getCurrentThemeDirectory();
        $directory = opendir($directoryPath);

        while ($file = readdir($directory)) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            $templatePath = $directoryPath . $file;
            $xml = new Xml($templatePath);
            if (!$xml->open()) {
                continue;
            }

            $templates[] = [
                Page::TEMPLATE_ID => $xml->getNode('header/id', true),
                Page::TEMPLATE_NAME => $xml->getNode('header/name', true),
                Page::TEMPLATE_PREVIEW => trim($xml->getNode('header/preview', true))
            ];
        }

        return $templates;
    }

    private function getComponentTemplate($id)
    {
        if ($id < 0) {
            return [];
        }

        // TODO : Change to getCurrentThemeDirectory();
        $filePath = 'themes/templates/default/components/template' . $id . '.xml';

        if (!file_exists($filePath)) {
            return ['error' => 'File not found']; // Error;
        }

        $xml = new Xml($filePath);
        if (!$xml->open()) {
            return [];
        }

        $config = [];
        $groups = [];
        /** @var SimpleXMLElement $config */
        foreach ($xml->getNode('config/groups') as $xmlConfig) {
            $group = [];
            $group[Editable::GROUP_LABEL] = (String)$xmlConfig->xpath('label')[0];
            $group[Editable::GROUP_FIELDS] = [];

            $fields = $xmlConfig->xpath('fields')[0];
            /** @var SimpleXMLElement|array $attributes */
            foreach ($fields as $field => $attributes) {
                $fieldConfig = [];

                $fieldConfig['label'] = (string)$attributes['label'];
                $fieldConfig['type'] = (string)$attributes['type'];

                $group[Editable::GROUP_FIELDS][$field] = $fieldConfig;
            }

            $groups[] = $group;
        }

        $config[Editable::FORM_GROUPS] = $groups;
        $config[Editable::FORM_STRUCT] = [
            'method' => 'post',
            'action' => '#',
            'hide_header' => 1,
            'submit' => $xml->getNode('config/struct/submit', true),
            'file' => $xml->getNode('config/struct/file', true)
        ];

        return $config;
    }

    public function componentAction($params)
    {
        if (!isset($params[Routing::PARAMS_URL][0])) {
            $template = $this->getComponentTemplates();
            echo json_encode($template);

        } else {
            $templateConfig = $this->getComponentTemplate($params[Routing::PARAMS_URL][0]);

            $view = new View('back', 'ajax/index', 'ajax');
            $view->includeModal('form', $templateConfig);
        }
    }

    public function validateComponentAction($params){

    }

    public function editAction()
    {

    }

    public function deleteAction()
    {

    }
}
