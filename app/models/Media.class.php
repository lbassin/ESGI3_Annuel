<?php
class Media extends BaseSql
{
    protected $id;
    protected $name;
    protected $path;
    protected $type;
    protected $extension;
    protected $id_user;

    public function __construct(
        $id = -1,
        $name = null,
        $path = null,
        $type = null,
        $extension = null,
        $id_user = null
    )
    {
        $this->setId($id);
        $this->setName($name);
        $this->setPath($path);
        $this->setType($type);
        $this->setExtension($extension);
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

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function setExtension($extension)
    {
        $this->extension = $extension;
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