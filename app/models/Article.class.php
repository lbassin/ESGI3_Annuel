<?php

class Article extends BaseSql
{
    protected $id;
    protected $title;
    protected $content;
    protected $url;
    protected $publish;
    protected $visibility;
    protected $id_user;
    protected $id_survey;

    public function __construct() {

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

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
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

    public function getVisibility()
    {
        return $this->visibility;
    }

    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    public function getIdSurvey()
    {
        return $this->id_user;
    }

    public function setIdSurvey($id_user)
    {
        $this->id_user = $id_user;
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
            $data[] = $componentData;
        }

        return $data;
    }

    public function getFormConfig()
    {
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::FORM_ACTION => Helpers::getAdminRoute('article/save'),
                Editable::FORM_BACK_URL => Helpers::getAdminRoute('article'),
                Editable::FORM_SUBMIT => 'Save'
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Article Optimisation',
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
                        'content' => [
                            'type' => 'textarea',
                            'label' => 'Contenue de l\'article :',
                            'class' => 'one-col',
                            'value' => $this->getContent()
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
                            'id' => 'article/new',
                            'data' => $this->getComponents()
                        ]
                    ]
                ]
            ]
        ];
    }

    public function getListConfig() {
        return [
            'struct' => [
                'title' => 'Articles',
                'newLink' => Helpers::getAdminRoute('article/new'),
                'header' => [
                    '',
                    'ID',
                    'Title',
                    'Content',
                    'Url',
                    'Action'
                ]
            ],
            'rows' => $this->getListData()
        ];
    }

    public function getListData() {
        $articles = $this->getAll();

        $listData = [];

        /** @var Article $article */
        foreach ($articles as $article) {
            $articleData = [
                [
                    'type' => 'checkbox',
                    'value' => ''
                ],
                [
                    'type' => 'text',
                    'value' => $article->getId()
                ],
                [
                    'type' => 'text',
                    'value' => $article->getTitle()
                ],
                [
                    'type' => 'text',
                    'value' => $article->getContent()
                ],
                [
                    'type' => 'text',
                    'value' => $article->getUrl()
                ],
                [
                    'type' => 'action',
                    'id' => $article->getId()
                ]
            ];

            $listData[] = $articleData;
        }

        return $listData;
    }
}
