<?php

class MenuControllerBack extends Controller
{
    public function newAction($params = [])
    {
        $menu = new Menu();
        $menu->setId(1);

        $params = [
            'jsonsublink' => $menu->getSubmenu(),
            'nbSublink' => 1,
        ];
        parent::newAction($params);
    }

    public function saveAction($params = [], $multiple = false)
    {
//            'child' => [
//                0 => [
//                    'label' => 'test1',
//                    'url'   => 'test1'
//                ],
//                1 => [
//                    'label' => 'test2',
//                    'url'   => 'test2'
//                ],
        $idParent = parent::saveAction([Routing::PARAMS_POST => $params[Routing::PARAMS_POST]['parent']], true);

        if (!empty($params[Routing::PARAMS_POST]['child'])) {
            $count = count($params[Routing::PARAMS_POST]['child']) -1;
            foreach ($params[Routing::PARAMS_POST]['child'] as $key => $subLink) {
                $subLink['parent_id'] = $idParent;
                parent::saveAction([Routing::PARAMS_POST => $subLink], (($count != $key) ? -1 : false));
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
