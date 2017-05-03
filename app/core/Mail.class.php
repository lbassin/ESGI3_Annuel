<?php

class Mail
{
    public function __construct()
    {

    }

    public function send($to, $subject, $message)
    {
        if(empty($to) || !filter_var($to, FILTER_VALIDATE_EMAIL)) {
            die('pd');
        } else {
            mail($to, $subject, $message);
        }
    }
}