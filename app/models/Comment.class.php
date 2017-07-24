<?php
class Comment extends Sql implements Listable, Editable
{
    protected $id;
    protected $content;
    protected $moderate;

    public function __construct($data = '')
    {
        $this->belongsTo(['article', 'user']);
        $this->manyMany(['user']);

        parent::__construct($data);
    }

    public function getListConfig($configList = null)
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
                    'Report',
                    'Moderate',
                    'Article',
                    'User',
                    'Action'
                ]
            ],
            Listable::LIST_ROWS => $this->getListData($configList)
        ];
    }

    public function getListData($configList = null)
    {
        $limits = [
            'limit' => $configList['size'],
            'offset' => $configList['size'] * ($configList['page'] - 1)
        ];
        $search = isset($configList['search']) ? ['search' =>  $configList['search']] : [];
        $comments = $this->getAll($search, $limits);

        $listData = [];

        foreach ($comments as $comment) {
            $comment->getUser();
            $comment->getArticle();
            $commentData = [
                [
                    'type' => 'checkbox',
                    'value' => ''
                ],
                [
                    'type' => 'text',
                    'value' => $comment->id()
                ],
                [
                    'type' => 'text',
                    'value' => $comment->content()
                ],
                [
                    'type' => 'text',
                    'value' => ($comment->users() != null) ? count($comment->users()) : 'Aucun'
                ],
                [
                    'type' => 'text',
                    'value' => ($comment->moderate() == false) ? 'Activé' : 'Desactivé'
                ],
                [
                    'type' => 'text',
                    'value' => $comment->article()->title()
                ],
                [
                    'type' => 'text',
                    'value' => $comment->user()->firstname() . ' ' . $comment->user()->lastname()
                ],
                [
                    'type' => 'action',
                    'id' => $comment->id()
                ]
            ];

            $listData[] = $commentData;
        }

        return $listData;
    }

    public function validate()
    {
        return [
            'content' => [
                'required' => true,
                'min' => 1,
                'max' => 255,
            ]
        ];
    }

    public function getFormConfig()
    {
        $listModerate = [
            'Non' => 0,
            'Oui' => 1
        ];
        $this->getUser();
        $this->getArticle();
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::MODEL_URL => Helpers::getAdminRoute('comment'),
                Editable::MODEL_ID => $this->id(),
                Editable::FORM_SUBMIT => 'Save'
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Commentaires',
                    Editable::GROUP_FIELDS => [
                        'id' => [
                            'type' => 'hidden',
                            'value' => $this->id()
                        ],
                        'content' => [
                            'type' => 'text',
                            'label' => 'Content :',
                            'class' => 'two-col',
                            'value' => $this->content()
                        ],
                        'article' => [
                            'type' => 'hidden',
                            'value' => ($this->article() != null) ? $this->article()->id() : ''
                        ],
                        'user' => [
                            'type' => 'hidden',
                            'value' => ($this->user() != null) ? $this->user()->id() : ''
                        ]
                    ]
                ],
                [
                    Editable::GROUP_LABEL => 'Modération',
                    Editable::GROUP_FIELDS => [
                        'report' => [
                            'type' => 'text',
                            'label' => 'Nombre de fois reportés :',
                            'disabled' => true,
                            'class' => 'two-col',
                            'value' => (($this->users() != null) ? count($this->users()) : 0) . ' fois !'
                        ],
                        'moderate' => [
                            'type' => 'select',
                            'label' => 'Cacher ce commentaire ?',
                            'options' => $listModerate,
                            'value' => $this->moderate()
                        ]
                    ]
                ]
            ]
        ];
    }
}
