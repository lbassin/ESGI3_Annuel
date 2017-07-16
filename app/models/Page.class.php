<?php

class Page extends Sql implements Listable, Editable
{
    const TEMPLATE_ID = 'id';
    const TEMPLATE_NAME = 'name';
    const TEMPLATE_PREVIEW = 'preview';

    protected $id;
    protected $title;
    protected $description;
    protected $url;
    protected $publish;

    public function __construct($data = '')
    {
        $this->hasMany(['page_component']);
        $data['publish'] = 0;
        $data['visibility'] = 0;

        parent::__construct($data);
    }

    public function getComponents()
    {
        $component = new Page_Component();
        $components = $component->getAll(['id_page' => $this->id()]);

        $data = [];
        /** @var Page_Component $component */
        foreach ($components as $component) {
            $componentData['config'] = $component->config();
            $componentData['template_id'] = $component->template_id();
            $componentData['id'] = $component->id();
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
                    'Url',
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
                    'value' => $page->id()
                ],
                [
                    'type' => 'text',
                    'value' => $page->title()
                ],
                [
                    'type' => 'text',
                    'value' => $page->url()
                ],
                [
                    'type' => 'text',
                    'value' => $page->publish() ? 'Oui' : 'Non'
                ],
                [
                    'type' => 'action',
                    'id' => $page->id()
                ]
            ];

            $listData[] = $pageData;
        }

        return $listData;
    }

    public function getFormConfig()
    {
        $this->getPage_component();
        $data = [];
        foreach ($this->page_components() as $key => $component) {
            $data[$key] = $component->toArray();
        }
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::MODEL_URL => Helpers::getAdminRoute('page'),
                Editable::MODEL_ID => $this->id()
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Search Engine Optimisation',
                    Editable::GROUP_FIELDS => [
                        'id' => [
                            'type' => 'hidden',
                            'value' => $this->id()
                        ],
                        'title' => [
                            'type' => 'text',
                            'label' => 'Title',
                            'required' => 1,
                            'value' => $this->title()
                        ],
                        'url' => [
                            'type' => 'text',
                            'label' => 'URL',
                            'required' => 1,
                            'value' => $this->url()
                        ],
                        'description' => [
                            'type' => 'textarea',
                            'label' => 'Description',
                            'required' => 1,
                            'value' => $this->description()
                        ],
                        'publish' => [
                            'type' => 'checkbox',
                            'label' => 'Publié',
                            'value' => $this->publish()
                        ]
                    ]
                ],
                [
                    Editable::GROUP_LABEL => 'Content',
                    Editable::GROUP_FIELDS => [
                        'preview' => [
                            'type' => 'widget',
                            'id' => 'page/new',
                            'data' => $data,
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