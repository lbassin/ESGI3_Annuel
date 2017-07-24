<?php
class Reset_Password extends Sql
{
    protected $id;
    protected $token;


    public function __construct($data = '')
    {
        $this->belongsTo(['user']);
        parent::__construct($data);
    }

    public function generateToken() {
        $token = base64_encode(time() . uniqid());
        $this->token = $token;
        return $token;
    }
}