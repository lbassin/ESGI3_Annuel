<?php
class Menu extends BaseSql
{
    protected $id;
    protected $name;
    protected $is_selected;
    protected $links;

    public function __construct(
        $id = -1,
        $name = null,
        $is_selected = false,
        $links = null
    )
    {
        $this->setId($id);
        $this->setName($name);
        $this->setIsSelected($is_selected);
        $this->setLinks($links);

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

    public function getIsSelected()
    {
        return $this->is_selected;
    }

    public function setIsSelected($is_selected)
    {
        $this->is_selected = $is_selected;
    }

    public function getLinks()
    {
        return $this->links;
    }

    public function setLinks($links)
    {
        $this->links = $links;
    }


}