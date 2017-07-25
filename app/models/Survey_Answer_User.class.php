<?php
class Survey_Answer_User extends Sql
{
    protected $id;
    protected $id_answer;
    protected $id_user;

    public function __construct($data = '')
    {
        parent::__construct($data);
    }
}