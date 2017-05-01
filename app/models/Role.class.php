<?php

class Role extends BaseSql
{
    protected $id;
    protected $name;

    public function __construct()
    {
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

    public function getAllAsOptions()
    {
        $roles = $this->getAll();

        $data = [];
        foreach ($roles as $role) {
            if (!empty($role->getName())) {
                $data[$role->getName()] = $role->getId();
            }
        }

        return $data;
    }

}