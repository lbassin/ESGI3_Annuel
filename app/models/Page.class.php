<?php

class Page extends BaseSql implements Listable, Editable
{
    const TEMPLATE_ID = 'id';
    const TEMPLATE_NAME = 'name';
    const TEMPLATE_PREVIEW = 'preview';

    protected $id;
    protected $name;
    protected $content;
    protected $description;
    protected $url;
    protected $visibility;
    protected $publish;
    protected $meta_title;
    protected $meta_description;

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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getVisibility()
    {
        return $this->visibility;
    }

    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }

    public function getPublish()
    {
        return $this->publish;
    }

    public function setPublish($publish)
    {
        $this->publish = $publish;
    }

    public function getMetaTitle()
    {
        return $this->meta_title;
    }

    public function setMetaTitle($meta_title)
    {
        $this->meta_title = $meta_title;
    }

    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    public function setMetaDescription($meta_description)
    {
        $this->meta_description = $meta_description;
    }

    public function getListConfig(){
        return [
            Listable::LIST_STRUCT => [
                Listable::LIST_TITLE => 'Pages',
                Listable::LIST_NEW_LINK => Helpers::getAdminRoute('page/new'),
                Listable::LIST_EDIT_LINK => Helpers::getAdminRoute('page/edit'),
                Listable::LIST_HEADER => [
                    '',
                    'ID',
                    'Title',
                    'Last update',
                    'Visible',
                    'Action'
                ]
            ],
            Listable::LIST_ROWS => $this->getListData()
        ];
    }

    public function getListData(){
        $pages = $this->getAll();

        $listData = [];

        /** @var Page $page */
        foreach ($pages as $page){
            $pageData = [
                [
                    'type' => 'checkbox',
                    'value' => ''
                ],
                [
                    'type' => 'text',
                    'value' => $page->getId()
                ],
                [
                    'type' => 'text',
                    'value' => $page->getName()
                ],
                [
                    'type' => 'text',
                    'value' => 'TODO'
                ],
                [
                    'type' => 'text',
                    'value' => $page->getVisibility()
                ],
                [
                    'type' => 'action',
                    'id' => $page->getId()
                ]
            ];

            $listData[] = $pageData;
        }

        return $listData;
    }

    public function getFormConfig()
    {
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::FORM_ACTION => Helpers::getAdminRoute('page/add'),
                Editable::FORM_SUBMIT => 'Save'
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Test',
                    Editable::GROUP_FIELDS => [
                        'test' => [
                            'type' => 'text'
                        ]
                    ]
                ]
            ]
        ];
    }

}