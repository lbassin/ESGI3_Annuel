<?php
class Page extends BaseSql
{
    protected $id;
    protected $name;
    protected $content;
    protected $description;
    protected $url;
    protected $visibility;
    protected $publish;
    protected $meta_title;
    protected $meta_description;

    public function __construct(
        $id = -1,
        $name = null,
        $content = null,
        $description = null,
        $slug = null,
        $visibility = 0,
        $publish = 0,
        $meta_title = null,
        $meta_description = null
    )
    {
        $this->setId($id);
        $this->setName($name);
        $this->setContent($content);
        $this->setDescription($description);
        $this->setUrl($slug);
        $this->setVisibility($visibility);
        $this->setPublish($publish);
        $this->setMetaTitle($meta_title);
        $this->setMetaDescription($meta_description);

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

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
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

    public function getMetaTitle()
    {
        return $this->meta_title;
    }

    public function setMetaTitle($meta_title)
    {
        $this->meta_title = $meta_title;
    }

    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    public function setMetaDescription($meta_description)
    {
        $this->meta_description = $meta_description;
    }
}