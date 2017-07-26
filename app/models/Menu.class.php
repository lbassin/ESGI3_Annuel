<?php

class Menu extends Sql implements Editable, Listable
{
    protected $id;
    protected $label;
    protected $url;
    protected $parent_id;

    public function __construct($data = '')
    {
        parent::__construct($data);
    }

    public function validate()
    {
        return [
            'label' => [
                'required' => true,
            ],
            'url' => [
                'required' => true,
            ],
        ];
    }

    public function getSubmenu()
    {
        $dataMenu = [];
        foreach ($this->getAll(['parent_id' => $this->id()]) as $key => $subMenu) {
            $dataMenu[$subMenu->id()]['label'] = $subMenu->label();
            $dataMenu[$subMenu->id()]['url'] = $subMenu->url();
        }
        return $dataMenu;
    }

    public function getFormConfig()
    {
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::MODEL_URL => Helpers::getAdminRoute('menu'),
                Editable::MODEL_ID => $this->id(),
                Editable::FORM_SUBMIT => 'Save'
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Parent menu',
                    Editable::GROUP_FIELDS => [
                        'id' => [
                            'type' => 'hidden',
                            'value' => $this->id()
                        ],
                        'label' => [
                            'type' => 'text',
                            'label' => 'Label',
                            'value' => $this->label()
                        ],
                        'url' => [
                            'type' => 'text',
                            'label' => 'URL',
                            'value' => $this->url()
                        ]
                    ]
                ],
                [
                    Editable::GROUP_LABEL => 'Dropdown',
                    Editable::GROUP_FIELDS => [
                        'preview' => [
                            'type' => 'widget',
                            'id' => 'menu/new',
                            'data' => $this->getSubMenu()
                        ]
                    ]
                ]
            ]
        ];
    }

    public function getListConfig($configList = null)
    {
        return [
            Listable::LIST_STRUCT => [
                Listable::LIST_TITLE => 'Menus',
                Listable::LIST_NEW_LINK => Helpers::getAdminRoute('menu/new'),
                Listable::LIST_EDIT_LINK => Helpers::getAdminRoute('menu/edit'),
                Listable::LIST_HEADER => [
                    '',
                    'ID',
                    'Label',
                    'Action'
                ]
            ],
            Listable::LIST_ROWS => $this->getListData($configList)
        ];
    }

    public function getListData($configList = null)
    {
        $limits = [
            'limit' => $configList['size'],
            'offset' => $configList['size'] * ($configList['page'] - 1)
        ];
        $search = isset($configList['search']) ? ['search' =>  $configList['search']] : [];
        $menus = $this->getParent($search, $limits);
        $listData = [];

        foreach ($menus as $menu) {
            $menuData = [
                [
                    'type' => 'checkbox',
                    'value' => ''
                ],
                [
                    'type' => 'text',
                    'value' => $menu->id()
                ],
                [
                    'type' => 'text',
                    'value' => $menu->label()
                ],
                [
                    'type' => 'action',
                    'id' => $menu->id()
                ]

            ];
            $listData[] = $menuData;
        }
        return $listData;
    }

    public function getParent($search, $limits)
    {
        $menus = $this->getAll($search, $limits);
        $parentMenu = [];
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id() == null) {
                $parentMenu[] = $menu;
            }
        }
        return $parentMenu;
    }

}