<?php
class Page extends BaseSql
{
    protected $id;
    protected $name;
    protected $content;
    protected $description;
    protected $slug;
    protected $visibility;
    protected $publish;
    protected $id_user;

    public function __construct(
        $id = -1,
        $name = null,
        $content = null,
        $description = null,
        $slug = null,
        $visibility = 0,
        $publish = 0,
        $id_user = null
    )
    {
        $this->setId($id);
        $this->setName($name);
        $this->setContent($content);
        $this->setDescription($description);
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
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