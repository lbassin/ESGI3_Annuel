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

    public function validate(array $data) {
        $title = $data['title'];
        $content = $data['content'];
        $url = $data['url'];

        if (empty($title)) {
            Session::addError("Veillez indiquer un titre a votre article");
        } else if (strlen($title) > 255) {
            Session::addError("Le titre est trop long");
        }

        if (empty($content)) {
            Session::addError("Veillez indiquer un contenue a votre article");
        } else if (strlen($title) > 255) {
            Session::addError("Le titre est trop long");
        }

        if (empty($url)) {
            Session::addError("Veillez indiquer une url a votre article");
        } elseif (strlen($url) > 255) {
            Session::addError("L'url est trop long");
        }
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
                            'type' => 'checkbox',
                            'label' => 'Visibilité :',
                            'class' => 'one-col'
                        ]
                    ]
                ],
            ]
        ];
    }
}
