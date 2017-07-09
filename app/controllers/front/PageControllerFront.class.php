<?php

class PageControllerFront
{

    public function indexAction($params)
    {
        $page = new Page();
        $page->populate(['url' => $params['url']]);

        if ($page->getId() === null) {
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
        ob_start();
        include 'themes/templates/default/components/template1.php';
        $render = ob_get_clean();

        return $render;
    }
}
