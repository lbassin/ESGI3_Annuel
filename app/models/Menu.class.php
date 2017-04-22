<?php
class Menu extends BaseSql
{
    protected $id;
    protected $label;
    protected $url;
    protected $parent_id;

    public function __construct(
        $id = -1,
        $label = null,
        $url = false,
        $parent_id = null
    )
    {
        $this->setId($id);
        $this->setLabel($label);
        $this->setUrl($url);
        $this->setParentId($parent_id);

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

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

}