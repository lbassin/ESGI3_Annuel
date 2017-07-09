<?php
class Reset_Password extends BaseSql
{
    protected $id;
    protected $token;
    protected $user_id;


    public function __construct()
    {
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

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function generateToken() {
        $token = base64_encode(time() . uniqid());
        $this->token = $token;
        return $token;
    }
}