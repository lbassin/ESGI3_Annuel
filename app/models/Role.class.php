<?php

class Role extends BaseSql
{
    protected $id;
    protected $name;

    public function __construct(
        $id = -1,
        $name = null
    ) {
        $this->setId($id);
        $this->setName($name);

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

}