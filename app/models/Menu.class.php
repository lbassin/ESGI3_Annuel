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

    public function getFormConfig()
    {
        // TODO: Implement getFormConfig() method.
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
        $menus = $this->getAll();
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

}