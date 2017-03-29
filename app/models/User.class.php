<?php

class User extends BaseSql
{

    protected $id;
    protected $email;
    protected $lastname;
    protected $firstname;
    protected $pwd;
    protected $status;
    protected $permission;

    public function __construct(
        $id = -1,
        $email = null,
        $lastname = null,
        $firstname = null,
        $pwd = null,
        $status = 0,
        $permission = 0
    ) {
        $this->setId($id);
        $this->setEmail($email);
        $this->setLastname($lastname);
        $this->setFirstname($firstname);
        $this->setPwd($pwd);
        $this->setStatus($status);
        $this->setPermission($permission);

        parent::__construct();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setEmail($email)
    {
        $email = trim($email);

        $this->email = $email;
    }

    public function setLastname($lastname)
    {
        $lastname = trim($lastname);

        $this->lastname = $lastname;
    }

    public function setFirstname($firstname)
    {
        $firstname = trim($firstname);

        $this->firstname = $firstname;
    }

    public function setPwd($pwd)
    {
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);

        $this->pwd = $pwd;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setPermission($permission)
    {
        $this->permission = $permission;
    }

}
