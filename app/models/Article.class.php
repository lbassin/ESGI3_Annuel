<?php

class Article extends BaseSql implements Listable, Editable
{
    protected $id;
    protected $title;
    protected $content;
    protected $url;
    protected $publish;
    protected $visibility;
    protected $user;
    protected $survey;

    public function __construct() {
        array_push($this->foreignValues, 'user', 'survey');

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

    public function getUser()
    {
        if (!isset($this->user)) {
            return new User();
        }

        $user = new User();
        $user->populate(['id' => $this->user]);

        return $user;
    }

    public function setUser($user)
    {
        if ($user instanceof User) {
            $this->user = $user;
        } else {
            $newUser = new User();
            $newUser->populate(['id' => intval($user)]);
            $this->user = $newUser;
        }
    }

    public function getSurvey()
    {
        if (!isset($this->survey)) {
            return new Survey();
        }

        $survey = new Survey();
        $survey->populate(['id' => $this->survey]);

        return $survey;
    }

    public function setSurvey($survey)
    {
        if ($survey instanceof Survey) {
            $this->survey = $survey;
        } else {
            $newSurvey = new Survey();
            $newSurvey->populate(['id' => intval($survey)]);
            $this->survey = $newSurvey;
        }
    }

    public function validate($data) {

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
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::FORM_ACTION => Helpers::getAdminRoute('article/save'),
                Editable::FORM_SUBMIT => 'Sauvegarder'
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Article',
                    Editable::GROUP_FIELDS => [
                        'title' => [
                            'type' => 'text',
                            'label' => 'Titre de l\'article :',
                            'class' => 'two-col',
                            'value' => $this->getTitle()
                        ],
                        'content' => [
                            'type' => 'textarea',
                            'label' => 'Contenue de l\'article :',
                            'class' => 'one-col',
                            'value' => $this->getContent()
                        ],
                        'url' => [
                            'type' => 'text',
                            'label' => 'Url :',
                            'class' => 'one-col',
                            'value' => $this->getUrl()
                        ]
                    ]
                ],
                [
                    Editable::GROUP_LABEL => 'Configurations',
                    Editable::GROUP_FIELDS => [
                        'publish' => [
                            'type' => 'checkbox',
                            'label' => 'Publié :',
                            'class' => 'one-col',
                            'value' => $this->getPublish()
                        ],
                        'visibility' => [
                            'type' => 'checkbox',
                            'label' => 'Visibilité :',
                            'class' => 'one-col',
                            'value' => $this->getVisibility()
                        ],
                        'survey' => [
                            'type' => 'select',
                            'label' => 'Survey :',
                            'class' => 'one-col',
                            'options' => $this->getSurvey()->getAllAsOptions(),
                            'value' => $this->getSurvey()->getId()
                        ]
                    ]
                ]
            ]
        ];
    }

    public function getListConfig() {
        return [
            Listable::LIST_STRUCT => [
                Listable::LIST_NEW_LINK => Helpers::getAdminRoute('article/new'),
                Listable::LIST_EDIT_LINK => Helpers::getAdminRoute('article/edit'),
                Listable::LIST_HEADER => [
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
