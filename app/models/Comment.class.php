<?php
class Comment extends Sql implements Listable, Editable
{
    protected $id;
    protected $content;
    protected $article;
    protected $user;

    public function __construct($data = '')
    {
        $this->foreignKey(['article', 'user']);

        parent::__construct($data);
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

    public function validate(array $data)
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
