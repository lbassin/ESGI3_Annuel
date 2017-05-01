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

    public function __construct()
    {
        $this->foreignValues = ['role'];

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

    public function validate(array $data)
    {
        // TODO

        return [];
    }

    public function getFormConfig()
    {
        return [
            'struct' => [
                'method' => 'post',
                'action' => Helpers::getAdminRoute('user/add'),
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
                            'options' => $this->getRole()->getAllAsOptions(),
                            'value' => $this->getRole()->getId()
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
            return new Role;
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
            'rows' => $this->getListData()
        ];
    }

    public function getListData()
    {
        $users = $this->getAll();

        $listData = [];

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

}
