<?php

class Article extends BaseSql
{
    protected $id;
    protected $title;
    protected $content;
    protected $slug;
    protected $visibility;
    protected $publish;
    protected $id_user;

    public function __construct(
        $id = -1,
        $title = null,
        $content = null,
        $slug = null,
        $visibility = 0,
        $publish = 0,
        $id_user = null
    )
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setContent($content);
        $this->setSlug($slug);
        $this->setVisibility($visibility);
        $this->setPublish($publish);
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

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getVisibility()
    {
        return $this->visibility;
    }

    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }

    public function getPublish()
    {
        return $this->publish;
    }

    public function setPublish($publish)
    {
        $this->publish = $publish;
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
