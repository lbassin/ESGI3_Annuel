<?php
class Vote extends BaseSql
{
    protected $id;
    protected $id_choice;
    protected $id_user;

    public function __construct(
        $id = -1,
        $id_choice = 0,
        $id_user = null
    )
    {
        $this->setId($id);
        $this->setIdChoice($id_choice);
        $this->setIdUser($id_user);

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

    public function getIdChoice()
    {
        return $this->id_choice;
    }

    public function setIdChoice($id_choice)
    {
        $this->id_choice = $id_choice;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }
}