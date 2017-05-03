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

    public function __construct(
        $id = -1,
        $title = null,
        $content = null,
        $url = null,
        $visibility = 0,
        $publish = 0,
        $id_user = null
    )
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setContent($content);
        $this->setUrl($url);
        $this->setVisibility($visibility);
        $this->setPublish($publish);
        $this->setIdUser($id_user);

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

    public function getFormArticle() {
        return [
            'struct' => [
                'method' => 'post',
                'action' => Helpers::getAdminRoute('article/save'),
                'class' => '',

            ]
        ];
    }

    public function getFormConfig()
    {
        return [
            'struct' => [
                'method' => 'post',
                'action' => Helpers::getAdminRoute('article/save'),
                'class' => '',
                'submit' => 'Sauvegarder votre article'
            ],
            'groups' => [
                [
                    'label' => 'Article',
                    'fields' => [
                        'title' => [
                            'type' => 'text',
                            'label' => 'Titre de l\'article :',
                            'class' => 'two-col'
                        ],
                        'content' => [
                            'type' => 'textarea',
                            'label' => 'Contenue de l\'article :',
                            'class' => 'one-col'
                        ],
                        'url' => [
                            'type' => 'text',
                            'label' => 'Url :',
                            'class' => 'one-col'
                        ]
                    ]
                ],
                [
                    'label' => 'Configuration',
                    'fields' => [
                        'publish' => [
                            'type' => 'checkbox',
                            'label' => 'Publié :',
                            'class' => 'one-col'
                        ],
                        'visibility' => [
                            'type' => 'text',
                            'label' => 'Visibilité :',
                            'class' => 'one-col'
                        ]
                    ]
                ],
            ]
        ];
    }
}
