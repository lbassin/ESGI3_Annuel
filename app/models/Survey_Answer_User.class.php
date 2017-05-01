<?php
class Survey_Answer_User extends BaseSql
{
    protected $id;
    protected $id_answer;
    protected $id_user;

    public function __construct(
        $id = -1,
        $id_choice = 0,
        $id_user = null
    )
    {
        $this->setId($id);
        $this->setIdAnswer($id_choice);
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

    public function getIdAnswer()
    {
        return $this->id_answer;
    }

    public function setIdAnswer($id_answer)
    {
        $this->id_answer = $id_answer;
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