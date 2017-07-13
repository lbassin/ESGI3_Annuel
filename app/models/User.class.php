<?php

class User extends BaseSql implements Listable, Editable
{

    protected $id;
    protected $pseudo;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $avatar;
    protected $status;
    protected $role;

    public function __construct()
    {
        $this->foreignValues = ['role'];
        $this->defaultValues = [
            'status' => 0
        ];

        parent::__construct();
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $password;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $pseudo = trim($pseudo);
        $this->pseudo = $pseudo;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $email = trim($email);
        $this->email = $email;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $lastname = trim($lastname);
        $this->lastname = $lastname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $firstname = trim($firstname);
        $this->firstname = $firstname;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getRole()
    {
        if (!isset($this->role)) {
            if (!isset($this->id_role)) {
                return new Role;
            }

            $role = new Role;
            $role->populate(['id' => $this->id_role]);
            return $role;
        }
        return $this->role;
    }

    public function setRole($role)
    {
        if ($role instanceof Role) {
            $this->role = $role;
        } else {
            $newRole = new Role();
            $newRole->populate(['id' => $role]);
            $this->role = $newRole;
        }
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
                    'Email',
                    'Action'
                ]
            ],
            Listable::LIST_ROWS => $this->getListData($configList)
        ];
    }

    public function getListData($configList = null)
    {
        if (!isset($configList) || !isset($configList['size']) || !isset($configList['page'])) {
            $users = $this->getAll();
        } else {
            $users = $this->getPage($configList['size'], $configList['page']);
        }

        $listData = [];

        /** @var User $user */
        foreach ($users as $user) {
            $userData = [
                [
                    'type' => 'checkbox',
                    'value' => ''
                ],
                [
                    'type' => 'text',
                    'value' => $user->getId()
                ],
                [
                    'type' => 'text',
                    'value' => $user->getFirstname()
                ],
                [
                    'type' => 'text',
                    'value' => $user->getLastname()
                ],
                [
                    'type' => 'text',
                    'value' => $user->getEmail()
                ],
                [
                    'type' => 'action',
                    'id' => $user->getId()
                ]
            ];

            $listData[] = $userData;
        }

        return $listData;
    }

    public function getFormConfig()
    {
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::MODEL_URL => Helpers::getAdminRoute('user'),
                Editable::MODEL_ID => $this->getId(),
                Editable::FORM_FILE => 1
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Utilisateur',
                    Editable::GROUP_FIELDS => [
                        'id' => [
                            'type' => 'hidden',
                            'value' => $this->getId()
                        ],
                        'pseudo' => [
                            'type' => 'text',
                            'label' => 'Pseudo',
                            'value' => $this->getPseudo(),
                            'required' => true
                        ],
                        'email' => [
                            'type' => 'email',
                            'label' => 'Email',
                            'value' => $this->getEmail(),
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
                            'value' => $this->getLastname()
                        ],
                        'firstname' => [
                            'type' => 'text',
                            'label' => 'Prénom',
                            'value' => $this->getFirstname()
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
                            'value' => $this->getStatus()
                        ],
                        'role' => [
                            'type' => 'select',
                            'label' => 'Role',
                            'options' => $this->getRole()->getAllAsOptions(),
                            'value' => $this->getRole()->getId()
                        ]
                    ]
                ]
            ]
        ];
    }

    public function validate(array $data)
    {
        return [
            'pseudo' => [
                'unique' => 1,
                'require' => 1,
                'min' => 3,
                'max' => 255
            ],
            'email' => [
                'unique' => 1,
                'require' => 1,
                'min' => 3,
                'max' => 255
            ],
            'password' => [
            ]
        ];
    }

}
