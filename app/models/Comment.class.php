<?php
class Comment extends BaseSql implements Listable, Editable
{
    protected $id;
    protected $content;
    protected $article;
    protected $user;

    public function __construct()
    {
        $this->foreignValues[] = 'article';
        $this->foreignValues[] = 'user';

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

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getArticle()
    {
        if (!isset($this->article)) {
            if (!isset($this->id_article)) {
                return new Article;
            }

            $article = new Article;
            $article->populate(['id' => $this->id_article]);
            return $article;
        }
        return $this->article;
    }

    public function setArticle($article)
    {
        if ($article instanceof Article) {
            $this->article = $article;
        } else {
            $newArticle = new Article();
            $newArticle->populate(['id' => intval($article)]);

            $this->article = $newArticle;
        }
    }

    public function getUser()
    {
        if (!isset($this->user)) {
            if (!isset($this->id_user)) {
                return new User;
            }

            $user = new User;
            $user->populate(['id' => $this->id_user]);
            return $user;
        }
        return $this->user;
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

    public function getListConfig()
    {
        return [
            Listable::LIST_STRUCT => [
                Listable::LIST_TITLE => 'Commentaires',
                Listable::LIST_NEW_LINK => Helpers::getAdminRoute('comment/new'),
                Listable::LIST_EDIT_LINK => Helpers::getAdminRoute('comment/edit'),
                Listable::LIST_HEADER => [
                    '',
                    'ID',
                    'Content',
                    'Article',
                    'User',
                    'Action'
                ]
            ],
            Listable::LIST_ROWS => $this->getListData()
        ];
    }

    public function getListData()
    {
        $comments = $this->getAll();

        $listData = [];

        foreach ($comments as $comment) {
            $commentData = [
                [
                    'type' => 'checkbox',
                    'value' => ''
                ],
                [
                    'type' => 'text',
                    'value' => $comment->getId()
                ],
                [
                    'type' => 'text',
                    'value' => $comment->getContent()
                ],
                [
                    'type' => 'text',
                    'value' => $comment->getArticle()->getTitle()
                ],
                [
                    'type' => 'text',
                    'value' => $comment->getUser()->getFirstName() . ' ' . $comment->getUser()->getLastName()
                ],
                [
                    'type' => 'action',
                    'id' => $comment->getId()
                ]
            ];

            $listData[] = $commentData;
        }

        return $listData;
    }

    public function validate()
    {
        // TODO

        return [];
    }

    public function getFormConfig()
    {
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::FORM_ACTION => Helpers::getAdminRoute('comment/save'),
                Editable::FORM_SUBMIT => 'Sauvegarder',
                Editable::FORM_FILE => 1
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Commentaires',
                    Editable::GROUP_FIELDS => [
                        'id' => [
                            'type' => 'hidden',
                            'value' => $this->getId()
                        ],
                        'content' => [
                            'type' => 'text',
                            'label' => 'Content :',
                            'class' => 'two-col',
                            'value' => $this->getContent()
                        ],
                        'article' => [
                            'type' => 'hidden',
                            'value' => $this->getArticle()->getId()
                        ],
                        'user' => [
                            'type' => 'hidden',
                            'value' => $this->getUser()->getId()
                        ]
                    ]
                ]
            ]
        ];
    }


}
