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

    public function getParent_id()
    {
        return $this->parent_id;
    }

    public function setParent_id($parent_id)
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
            ],
        ];
    }

    public function getSubmenu()
    {
        $dataMenu = [];
        foreach ($this->getAll(['parent_id' => $this->getId()]) as $key => $subMenu) {
            $dataMenu[$subMenu->getId()]['link'] = $subMenu->getLabel();
            $dataMenu[$subMenu->getId()]['slug'] = $subMenu->getUrl();
        }
        return json_encode($dataMenu);
    }

    public function getFormConfig()
    {
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::MODEL_URL => Helpers::getAdminRoute('menu'),
                Editable::MODEL_ID => $this->getId(),
                Editable::FORM_SUBMIT => 'Save'
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Parent menu',
                    Editable::GROUP_FIELDS => [
                        'label' => [
                            'type' => 'text',
                            'label' => 'Label'
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
                            'id' => 'menu/new',
                            'data' => '', //$this->getSubMenu()
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
        $parentMenu = [];
        foreach ($menus as $key => $menu) {
            if ($menu->getParent_id() == null) {
                $parentMenu[] = $menu;
            }
        }
        return $parentMenu;
    }

}