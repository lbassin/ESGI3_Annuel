<?php

class User extends BaseSql
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

    public function __construct(
        $id = -1,
        $pseudo = null,
        $firstname = null,
        $lastname = null,
        $email = null,
        $password = null,
        $avatar = null,
        $status = 0,
        $role = 0
    ) {
        $this->setId($id);
        $this->setPseudo($pseudo);
        $this->setFirstname($firstname);
        $this->setLastname($lastname);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setAvatar($status);
        $this->setStatus($status);
        $this->setRole($role);

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

    public function getFormConfig()
    {
        return [
            'struct' => [
                'method' => 'post',
                'action' => 'user/add',
                'class' => '',
                'submit' => 'Sauvegarder',
                'file' => 1
            ],
            'groups' => [
                [
                    'label' => 'Utilisateur',
                    'fields' => [
                        'pseudo' => [
                            'type' => 'text',
                            'label' => 'Pseudo :',
                            'class' => 'two-col',
                            'value' => $this->getPseudo()
                        ],
                        'email' => [
                            'type' => 'email',
                            'label' => 'Email :',
                            'class' => 'one-col',
                            'value' => $this->getEmail()
                        ],
                        'password' => [
                            'type' => 'password',
                            'label' => 'Password :',
                            'class' => 'one-col'
                        ]
                    ]
                ],
                [
                    'label' => 'Profil',
                    'fields' => [
                        'lastname' => [
                            'type' => 'text',
                            'label' => 'Nom :',
                            'class' => 'one-col',
                            'value' => $this->getLastname()
                        ],
                        'firstname' => [
                            'type' => 'text',
                            'label' => 'Prénom :',
                            'class' => 'one-col',
                            'value' => $this->getFirstname()
                        ],
                        'avatar' => [
                            'type' => 'file',
                            'label' => 'Avatar :',
                            'accept' => 'image/*'
                        ]
                    ]
                ],
                [
                    'label' => 'Permissions',
                    'fields' => [
                        'status' => [
                            'type' => 'checkbox',
                            'label' => 'Actif :',
                            'class' => 'one-col',
                            'value' => $this->getStatus()
                        ],
                        'role' => [
                            'type' => 'select',
                            'label' => 'Role :',
                            'class' => 'one-col',
                            'options' => [ // Todo : Change to getRole()->getList();
                                'Administrateur' => 0,
                                'Moderateur' => 1,
                                'Utilisateur' => 2
                            ],
                            'value' => $this->getRole() // Todo : Change to getRole()->getId();
                        ]
                    ]
                ]
            ]
        ];
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
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
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getListConfig()
    {
        return [
            'struct' => [
                'title' => 'Utilisateurs',
                'newLink' => Helpers::getAdminRoute('user/new'),
                'header' => [
                    '',
                    'ID',
                    'Firstname',
                    'Lastname',
                    'Email',
                    'Action'
                ]
            ],
            'rows' => [
                [
                    [
                        'type' => 'checkbox',
                        'value' => ''
                    ],
                    [
                        'type' => 'text',
                        'value' => '1'
                    ],
                    [
                        'type' => 'text',
                        'value' => 'Laurent'
                    ],
                    [
                        'type' => 'text',
                        'value' => 'Bassin'
                    ],
                    [
                        'type' => 'text',
                        'value' => 'laurent@bassin.info'
                    ],
                    [
                        'type' => 'action',
                        'id' => 1
                    ]
                ],
                [
                    [
                        'type' => 'checkbox',
                        'value' => ''
                    ],
                    [
                        'type' => 'text',
                        'value' => '2'
                    ],
                    [
                        'type' => 'text',
                        'value' => 'Laurent'
                    ],
                    [
                        'type' => 'text',
                        'value' => 'Bassin'
                    ],
                    [
                        'type' => 'text',
                        'value' => 'laurent@bassin.info'
                    ],
                    [
                        'type' => 'action',
                        'id' => 2
                    ]
                ]
            ]
        ];
    }

}
