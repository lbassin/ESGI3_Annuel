<?php

class Comment_User extends Sql
{
    protected $id;
    protected $id_comment;
    protected $id_user;

    public function __construct($data = '')
    {
        parent::__construct($data);
    }
}