<?php

abstract class Front
{
    use Csrfable;
    protected $view;

    public function indexAction($params = [])
    {
        Csrf::generate();
        /** @var Menu $menu */
        $menu = new Menu();
        $menu = $menu->getAll(['parent_id' => null], ['limit' => 5]);
        foreach ($menu as $link) {
            $link->subMenu = $link->getSubmenu();
        }

        $this->view = new View('front');
        $this->view->assign('menu', $menu);
    }

}
