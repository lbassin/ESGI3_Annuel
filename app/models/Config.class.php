<?php
class Config extends BaseSql
{
    protected $id;
    protected $title;
    protected $ico;
    protected $logo;
    protected $url;
    protected $email;
    protected $language;
    protected $date;
    protected $registration;

    public function __construct(
        $id = -1,
        $title = null,
        $ico = null,
        $logo = null,
        $url = null,
        $email = null,
        $language = null,
        $date = null,
        $registration = null
    )
    {
        $this->id($id);
        $this->setTitle($title);
        $this->setIco($ico);
        $this->setLogo($logo);
        $this->setUrl($url);
        $this->setEmail($email);
        $this->setLanguage($language);
        $this->setDate($date);
        $this->setRegistration($registration);

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

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getIco()
    {
        return $this->ico;
    }

    public function setIco($ico)
    {
        $this->ico = $ico;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getRegistration()
    {
        return $this->registration;
    }

    public function setRegistration($registration)
    {
        $this->registration = $registration;
    }


}