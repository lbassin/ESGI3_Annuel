<?php

class Theme extends BaseSql implements Listable
{
    protected $id;
    protected $name;
    protected $directory;
    protected $is_selected;
    protected $version;
    protected $author;
    protected $description;

    public function __construct(
        $id = -1,
        $name = null,
        $directory = null,
        $is_selected = false,
        $version = null,
        $author = null,
        $description = null
    )
    {
        $this->setId($id);
        $this->setName($name);
        $this->setDirectory($directory);
        $this->setIsSelected($is_selected);
        $this->setVersion($version);
        $this->setAuthor($author);
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDirectory()
    {
        return $this->directory;
    }

    public function setDirectory($directory)
    {
        $this->directory = $directory;
    }

    public function isIsSelected()
    {
        return $this->is_selected;
    }

    public function setIsSelected($is_selected)
    {
        $this->is_selected = $is_selected;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setVersion($version)
    {
        $this->version = $version;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }


    public function getListConfig()
    {
        return [
            Listable::LIST_STRUCT => [
                Listable::LIST_TITLE => 'Thèmes',
                Listable::LIST_NEW_LINK => Helpers::getAdminRoute('page/new'),
                Listable::LIST_EDIT_LINK => Helpers::getAdminRoute('page/edit'),
                Listable::LIST_HEADER => [
                    '',
                    'ID',
                    '',
                    '',
                    '',
                    'Action'
                ]
            ],
            Listable::LIST_ROWS => $this->getListData()
        ];
    }

    public function getListData()
    {
        // TODO: Implement getListData() method.
    }
}