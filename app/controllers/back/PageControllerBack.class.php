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
    private function getPageTemplates()
    {
        $templates = [];
        $directoryPath = 'themes/templates/default/pages/'; // TODO : Change to getCurrentThemeDirectory();
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
                Page::TEMPLATE_PREVIEW => $xml->getNode('header/preview', true)
            ];
        }

        return $templates;
    }

    public function templatesAction(){
        $template = $this->getPageTemplates();

        echo json_encode($template);
    }

    public function editAction()
    {

    }

    public function deleteAction()
    {

    }
}
