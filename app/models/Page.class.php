<?php

class Page extends BaseSql implements Listable, Editable
{
    const TEMPLATE_ID = 'id';
    const TEMPLATE_NAME = 'name';
    const TEMPLATE_PREVIEW = 'preview';

    protected $id;
    protected $title;
    protected $description;
    protected $url;
    protected $publish;

    public function __construct()
    {
        $this->defaultValues = [
            'publish' => 0,
            'visibility' => 0
        ];

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

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
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

    public function getPublish()
    {
        return $this->publish;
    }

    public function setPublish($publish)
    {
        $this->publish = $publish;
    }

    public function getComponents()
    {
        $component = new Page_Component();
        $components = $component->getAll(['page_id' => $this->getId()]);

        $data = [];
        /** @var Page_Component $component */
        foreach ($components as $component) {
            $componentData = $component->getConfig();
            $componentData['template_id'] = $component->getTemplateId();
            $componentData['id'] = $component->getId();
            $data[] = $componentData;
        }

        return $data;
    }

    public function getListConfig()
    {
        return [
            Listable::LIST_STRUCT => [
                Listable::LIST_TITLE => 'Pages',
                Listable::LIST_NEW_LINK => Helpers::getAdminRoute('page/new'),
                Listable::LIST_EDIT_LINK => Helpers::getAdminRoute('page/edit'),
                Listable::LIST_HEADER => [
                    '',
                    'ID',
                    'Title',
                    'Publié',
                    'Action'
                ]
            ],
            Listable::LIST_ROWS => $this->getListData()
        ];
    }

    public function getListData()
    {
        $pages = $this->getAll();

        $listData = [];

        /** @var Page $page */
        foreach ($pages as $page) {
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
                    'value' => $page->getTitle()
                ],
                [
                    'type' => 'text',
                    'value' => $page->getPublish() ? 'Oui' : 'Non'
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
                Editable::MODEL_URL => Helpers::getAdminRoute('page'),
                Editable::MODEL_ID => $this->getId()
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Search Engine Optimisation',
                    Editable::GROUP_FIELDS => [
                        'id' => [
                            'type' => 'hidden',
                            'value' => $this->getId()
                        ],
                        'title' => [
                            'type' => 'text',
                            'label' => 'Title',
                            'required' => 1,
                            'value' => $this->getTitle()
                        ],
                        'url' => [
                            'type' => 'text',
                            'label' => 'URL',
                            'required' => 1,
                            'value' => $this->getUrl()
                        ],
                        'description' => [
                            'type' => 'textarea',
                            'label' => 'Description',
                            'required' => 1,
                            'value' => $this->getDescription()
                        ],
                        'publish' => [
                            'type' => 'checkbox',
                            'label' => 'Publié',
                            'value' => $this->getPublish()
                        ]
                    ]
                ],
                [
                    Editable::GROUP_LABEL => 'Content',
                    Editable::GROUP_FIELDS => [
                        'preview' => [
                            'type' => 'widget',
                            'id' => 'page/new',
                            'data' => $this->getComponents(),
                            'script' => 'wysiwyg.js'
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * @return array
     */
    public function getConstraints()
    {
        return [
            'title' => [
                'required' => 1,
                'min' => 4
            ],
            'url' => [
                'unique' => 1,
                'require' => 1,
            ],
            'description' => [
                'min' => 5
            ]
        ];
    }
}