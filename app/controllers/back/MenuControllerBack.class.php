<?php

class MenuControllerBack extends Controller
{
    public function saveAction($params = [], $multiple = false)
    {
        $idParent = parent::saveAction([Routing::PARAMS_POST => $params[Routing::PARAMS_POST]], true);

        $menu = new Menu();
        $menu->populate(['id' => $idParent]);

        $childrenIds = [];
        foreach ($params[Routing::PARAMS_POST]['child'] as $child) {
            if (empty($child['id'])) {
                continue;
            }
            $childrenIds[] = $child['id'];
        }

        foreach (array_keys($menu->getSubmenu()) as $childId) {
            if (in_array($childId, $childrenIds)) {
                continue;
            }
            $child = new Menu();
            $child->id($childId);

            try {
                $child->delete();
            } catch (Exception $ex) {
                Session::addError($ex->getMessage());
                Helpers::redirectBack();
            }
        }

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
        $menu->id($parent_id);
        $subMenu = $menu->getSubmenu();
        return $subMenu;
    }
}
