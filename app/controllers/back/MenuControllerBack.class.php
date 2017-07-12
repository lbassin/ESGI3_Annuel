<?php

class MenuControllerBack extends Controller
{
    public function saveAction($params = [], $multiple = false)
    {
        $idParent = parent::saveAction([Routing::PARAMS_POST => $params[Routing::PARAMS_POST]], true);


        if (!empty($params[Routing::PARAMS_POST]['child'])) {
            $count = count($params[Routing::PARAMS_POST]['child']) - 1;
            foreach ($params[Routing::PARAMS_POST]['child'] as $key => $subLink) {
                $subLink['parent_id'] = $idParent;
                parent::saveAction([
                    Routing::PARAMS_POST => $subLink,
                    Routing::PARAMS_GET => $params[Routing::PARAMS_GET]
                ], ($count != $key));
            }
        }
    }

    public function getSubMenu($parent_id)
    {
        $menu = new Menu();
        $menu->setId($parent_id);
        $subMenu = $menu->getSubmenu();
        return $subMenu;
    }
}
