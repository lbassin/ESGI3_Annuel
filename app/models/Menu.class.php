<?php
class Menu extends BaseSql implements Editable, Listable
{
    protected $id;
    protected $label;
    protected $url;
    protected $parent_id;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    public function validate()
    {
        return [
            'label' => [
                'required' => true,
            ],
            'url' => [
                'required' => true,
                'unique' => true,
            ]
        ];
    }

    public function getFormConfig()
    {
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::FORM_ACTION => Helpers::getAdminRoute('menu/format'),
                Editable::FORM_SUBMIT => 'Save'
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Parent menu',
                    Editable::GROUP_FIELDS => [
                        'label' => [
                            'type' => 'text',
                            'label' => 'Link'
                        ],
                        'url' => [
                            'type' => 'text',
                            'label' => 'URL'
                        ]
                    ]
                ],
                [
                    Editable::GROUP_LABEL => 'Dropdown',
                    Editable::GROUP_FIELDS => [
                        'preview' => [
                            'type' => 'widget',
                            'id' => 'menu/new'
                        ]
                    ]
                ]
            ]
        ];
    }

    public function getListConfig()
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
            Listable::LIST_ROWS => $this->getListData()
        ];
    }

    public function getListData()
    {
        $menus = $this->getParent();
        $listData = [];

        foreach ($menus as $menu) {
            $menuData = [
                [
                    'type' => 'checkbox',
                    'value' => ''
                ],
                [
                    'type' => 'text',
                    'value' => $menu->getId()
                ],
                [
                    'type' => 'text',
                    'value' => $menu->getLabel()
                ],
                [
                    'type' => 'action',
                    'id' => $menu->getId()
                ]

            ];
            $listData[] = $menuData;
        }
        return $listData;
    }

    public function getParent()
    {
        $menus = $this->getAll();
        foreach ($menus as $key => $menu) {
            if ($menu->getParentId() == null) {
                $parentMenu[] = $menu;
            }
        }
        return $parentMenu;
    }

}