<?php

class PageControllerFront
{

    public function indexAction($params)
    {
        $page = new Page();
        $page->populate(['url' => $params[Routing::PARAMS_URL][0]]);

        if ($page->id() === null) {
            Helpers::error404();
        }

        $components = $page->getComponents();
        $componentsRendered = [];
        foreach ($components as $component) {
            $componentsRendered[] = $this->generateComponent($component);
        }

        $view = new View('front');
        $view->assign('components', $componentsRendered);
    }

    private function generateComponent($data)
    {
        if (!isset($data['template_id'])) {
            return false;
        }
        $templateId = $data['template_id'];

        ob_start();
        include 'themes/templates/default/components/template' . $templateId . '.php';
        $render = ob_get_clean();

        return $render;
    }
}
