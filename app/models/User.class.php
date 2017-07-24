<?php

class User extends Sql implements Listable, Editable
{

    protected $id;
    protected $pseudo;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $avatar;
    protected $status;

    public function __construct($data = '')
    {
        $this->belongsTo(['role']);
        $this->hasMany(['article', 'comment']);
        $this->manyMany(['comment']);

        parent::__construct($data);
    }

    public function getListConfig($configList = null)
    {
        return [
            Listable::LIST_STRUCT => [
                Listable::LIST_TITLE => 'Utilisateurs',
                Listable::LIST_NEW_LINK => Helpers::getAdminRoute('user/new'),
                Listable::LIST_EDIT_LINK => Helpers::getAdminRoute('user/edit'),
                Listable::LIST_HEADER => [
                    '',
                    'ID',
                    'Firstname',
                    'Lastname',
                    'Pseudo',
                    'Email',
                    'Role',
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
        $users = $this->getAll($search, $limits);

        $listData = [];
        /** @var User $user */
        foreach ($users as $user) {
            $user->getRole();
            $userData = [
                [
                    'type' => 'checkbox',
                    'value' => ''
                ],
                [
                    'type' => 'text',
                    'value' => $user->id()
                ],
                [
                    'type' => 'text',
                    'value' => $user->firstname()
                ],
                [
                    'type' => 'text',
                    'value' => $user->lastname()
                ],
                [
                    'type' => 'text',
                    'value' => $user->pseudo()
                ],
                [
                    'type' => 'text',
                    'value' => $user->email()
                ],
                [
                    'type' => 'text',
                    'value' => $user->role()->name()
                ],
                [
                    'type' => 'action',
                    'id' => $user->id()
                ]
            ];
            $listData[] = $userData;
        }
        return $listData;
    }

    public function getFormConfig()
    {
        $this->getRole();
        $role = new Role();
        $listRole = $role->getAllAsOptions();
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::MODEL_URL => Helpers::getAdminRoute('user'),
                Editable::MODEL_ID => $this->id(),
                Editable::FORM_FILE => 1
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Utilisateur',
                    Editable::GROUP_FIELDS => [
                        'id' => [
                            'type' => 'hidden',
                            'value' => $this->id()
                        ],
                        'pseudo' => [
                            'type' => 'text',
                            'label' => 'Pseudo',
                            'value' => $this->pseudo(),
                            'required' => true
                        ],
                        'email' => [
                            'type' => 'email',
                            'label' => 'Email',
                            'value' => $this->email(),
                            'required' => true
                        ],
                        'password' => [
                            'type' => 'password',
                            'label' => 'Password',
                        ]
                    ]
                ],
                [
                    Editable::GROUP_LABEL => 'Profil',
                    Editable::GROUP_FIELDS => [
                        'lastname' => [
                            'type' => 'text',
                            'label' => 'Nom',
                            'value' => $this->lastname()
                        ],
                        'firstname' => [
                            'type' => 'text',
                            'label' => 'Prénom',
                            'value' => $this->firstname()
                        ],
                        'avatar' => [
                            'type' => 'file',
                            'label' => 'Avatar',
                            'accept' => 'image/*'
                        ]
                    ]
                ],
                [
                    Editable::GROUP_LABEL => 'Permissions',
                    Editable::GROUP_FIELDS => [
                        'status' => [
                            'type' => 'checkbox',
                            'label' => 'Actif',
                            'value' => $this->status()
                        ],
                        'role' => [
                            'type' => 'select',
                            'label' => 'Role',
                            'options' => $listRole,
                            'value' => $this->role()->id()
                        ]
                    ]
                ]
            ]
        ];
    }

    public function validate()
    {
        return [
            'pseudo' => [
                'require' => 1,
                'min' => 3,
                'max' => 255
            ],
            'email' => [
                'require' => 1,
                'min' => 3,
                'max' => 255
            ],
            'password' => [
            ]
        ];
    }

}
