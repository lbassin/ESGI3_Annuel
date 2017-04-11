<?php
class Swatche extends BaseSql
{
    protected $id;
    protected $name;
    protected $color;

    public function __construct(
        $id = -1,
        $name = null,
        $color = null
    )
    {
        $this->setId($id);
        $this->setName($name);
        $this->setColor($color);

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

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }




}