<?php

class Role extends Sql
{
    protected $id;
    protected $name;

    public function __construct($data = '')
    {
        $this->hasMany(['user']);

        parent::__construct($data);
    }

    public function getAllAsOptions()
    {
        $roles = $this->getAll();

        $data = [];
        foreach ($roles as $role) {
            if (!empty($role->name())) {
                $data[$role->name()] = $role->id();
            }
        }

        return $data;
    }

}