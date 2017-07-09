<?php

class MenuControllerBack extends Controller
{
    public function saveAction($params = [], $multiple = false)
    {
        $params['post'] = [
            'parent' => [
                'label' => 'papa',
                'url'   => 'papa',
                'token' => $params['post']['token'],
            ],
            'child' => [
                0 => [
                    'label' => 'test1',
                    'url'   => 'test1'
                ],
                1 => [
                    'label' => 'test2',
                    'url'   => 'test2'
                ],
            ]
        ];

        $idParent = parent::saveAction([Routing::PARAMS_POST => $params[Routing::PARAMS_POST]['parent']], true);

        if (!empty($params[Routing::PARAMS_POST]['child'])) {
            $count = count($params[Routing::PARAMS_POST]['child']) -1;
            foreach ($params[Routing::PARAMS_POST]['child'] as $key => $subLink) {
                $subLink['parent_id'] = $idParent;
                parent::saveAction([Routing::PARAMS_POST => $subLink], (($count != $key) ? -1 : false));
            }
        }
    }
}
