<?php

class ComponentControllerBack
{

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
                Page::TEMPLATE_PREVIEW => $xml->getNode('header/example', true)
            ];
        }

        return $templates;
    }

    private function getComponentTemplate($id)
    {
        if ($id < 0) {
            return [];
        }

        $xml = $this->getComponentXml($id);

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

    public function validateAction($params)
    {
        $data = $params[Routing::PARAMS_POST];
        if (!isset($data['template_id'])) {
            echo json_encode(['error' => true, 'message' => 'Template ID is missing']); // TODO : Error
        }
        $templateId = $data['template_id'];
        unset($data['token']);

        $constraints = $this->getComponentConstraints($templateId);

        $validator = new Validator($data, null);
        $validator->validate($constraints);
        $errors = Session::getErrors();
        Session::resetErrors();

        if (!empty($errors)) {
            echo json_encode(['errors' => $errors]);
        } else {
            $preview = $this->getComponentPreview($templateId);
            echo json_encode(['preview' => $preview, 'data' => $data]);
        }
    }

    private function getComponentConstraints($templateId)
    {
        $xml = $this->getComponentXml($templateId);
        $constraints = $xml->getNodeAsArray('validate');
        if (!$constraints) {
            return [];
        }

        return $constraints;
    }

    private function getComponentPreview($templateId)
    {
        $xml = $this->getComponentXml($templateId);
        $preview = $xml->getNode('header/preview', true);
        if (!$preview) {
            return [];
        }

        return $preview;
    }

    private function getComponentXml($templateId)
    {
        // TODO : Change to getCurrentThemeDirectory();
        $filePath = 'themes/templates/default/components/template' . $templateId . '.xml';

        if (!file_exists($filePath)) {
            Helpers::error404();
        }

        $xml = new Xml($filePath);
        if (!$xml->open()) {
            Helpers::error404();
        }
        return $xml;
    }
}
