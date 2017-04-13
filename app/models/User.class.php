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

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
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

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $lastname = trim($lastname);
        $this->lastname = $lastname;
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


    public function getForm()
    {
        return [
            'struct' => [
                'method' => 'post',
                'action' => 'user/add',
                'class' => 'form-group',
                'submit' => 'Texte',
                'file' => 1
            ],
            'data' => [
                'pseudo' => [
                    'type' => 'text',
                    'placeholder' => 'Pseudo',
                    'label' => 'Pseudo',
                    'required' => 1
                ],
                'firstname' => [
                    'type' => 'text',
                    'placeholder' => 'Prenom',
                    'label' => 'Votre prénom',
                    'required' => 1
                ],
                'lastname' => [
                    'type' => 'text',
                    'placeholder' => 'Nom',
                    'label' => 'Votre Nom',
                    'required' => 1
                ],
                'email' => [
                    'type' => 'email',
                    'placeholder' => 'Email',
                    'label' => 'Votre Email',
                    'required' => 1
                ],
                'password' => [
                    'type' => 'password',
                    'placeholder' => 'Password',
                    'label' => 'Votre Password',
                    'required' => 1
                ],
                'avatar' => [
                    'type' => 'file',
                    'label' => 'Votre Avatar',
                    'accept' => 'image/*,.gif'
                ],
                'status' => [
                    'type' => 'hidden',
                    'value' => 'test'
                ],
                'date' => [
                    'type' => 'date',
                    'label' => 'Date de naissance'
                ],
                'longtext' => [
                    'type' => 'textarea',
                    'placeholder' => 'ok',
                    'required' => 1
                ],
                'newsletter' => [
                    'type' => 'checkbox',
                    'label' => 'Newsletter ?'
                ],
                'role' => [
                    'type' => 'radio',
                    'value' => [
                        'Admin' => 1,
                        'Moderateur' => 2,
                        'Utilisateur' => 3
                    ]
                ],
                'country' => [
                    'type' => 'select',
                    'value' => [
                        'France' => 'fr',
                        'USA' => 'us',
                        'Italie' => 'it'
                    ]
                ]
            ]
        ];
    }

}
