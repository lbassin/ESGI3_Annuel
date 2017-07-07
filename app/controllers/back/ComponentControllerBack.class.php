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
        $component = new Page_Component();
        $component->setTemplateId($id);

        return $component->getFormConfig();
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

        $component = new Page_Component();
        $component->setTemplateId($templateId);
        $constraints = $component->getConstraints();

        $validator = new Validator($data, null);
        $validator->validate($constraints);
        $errors = Session::getErrors();
        Session::resetErrors();

        if (!empty($errors)) {
            echo json_encode(['errors' => $errors]);
        } else {
            $preview = $component->getPreview($templateId);
            echo json_encode(['preview' => $preview, 'data' => $data]);
        }
    }

}
