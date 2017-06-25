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

        $groups = [];
        /** @var SimpleXMLElement $config */
        foreach ($xml->getNode('config/groups') as $config) {
            $group = [];
            $group[Editable::GROUP_LABEL] = (String)$config->xpath('label')[0];
            $group[Editable::GROUP_FIELDS] = [];

            $fields = $config->xpath('fields')[0];
            /** @var SimpleXMLElement|array $attributes */
            foreach ($fields as $field => $attributes) {
                $fieldConfig = [];

                $fieldConfig['label'] = (string)$attributes['label'];
                $fieldConfig['type'] = (string)$attributes['type'];

                $group[Editable::GROUP_FIELDS][$field] = $fieldConfig;
            }

            $groups[] = $group;
        }

        return $groups;
    }

    public function templateAction($params)
    {
        if (!isset($params[Routing::PARAMS_URL][0])) {
            $template = $this->getComponentTemplates();
        } else {
            $template = $this->getComponentTemplate($params[Routing::PARAMS_URL][0]);
        }

        echo json_encode($template);
    }

    public function editAction()
    {

    }

    public function deleteAction()
    {

    }
}
