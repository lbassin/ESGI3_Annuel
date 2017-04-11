<?php
class Category extends BaseSql
{
    protected $id;
    protected $title;
    protected $description;

    public function __construct(
        $id = -1,
        $title = null,
        $description = null
    )
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setDescription($description);

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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }




}