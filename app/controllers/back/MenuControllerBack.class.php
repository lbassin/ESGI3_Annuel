<?php

class MenuControllerBack extends Controller
{
    /*
     * $params['post'] = [
     *      'label' => 'blabla',
     *      'url'   => 'blabla',
     *      [
     *          0 => [
         *          'label' => 'blabla',
         *          'url'   => 'blabla'
     *          ],
     *          1 => [
         *          'label' => 'blabla',
         *          'url'   => 'blabla'
     *          ],
     *      ]
     * ]
     * */
    public function formatAction($params)
    {
        $params['post'] = [
            'parent' => [
                'label' => 'papa',
                'url'   => 'papa',
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
        parent::saveAction([Routing::PARAMS_POST => $params[Routing::PARAMS_POST]['parent']], 1);
        $lastId = Session::getLastInsertId();
        $lengthSubMenu = count($params[Routing::PARAMS_POST]['child']);
        foreach ($params[Routing::PARAMS_POST]['child'] as $key => $childItem) {
            $childItem->setParentId($lastId);
            parent::saveAction(['post' => $childItem], --$lengthSubMenu);
        }
        exit();
    }
}
