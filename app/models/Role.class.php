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

    public static function checkRedac($className)
    {
        $autorisation = [
            'User',
            'Config',
            'Theme',
            'Menu',
            'Reset_Password'
        ];
        if (in_array($className, $autorisation)) {
            Session::addError('Vous n\'avez pas les droits pour effectuer cette action !');
        }
    }

    public static function checkUser($className)
    {
        $autorisation = [
            'Comment',
            'Comment_User',
            'Reset_Password',
            'Survey_Anser_User',
            'User'
        ];
        if (!in_array($className, $autorisation)) {
            Session::addError('Vous n\'avez pas les droits pour effectuer cette action !');
        }
    }
}