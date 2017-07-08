<?php

/**
 * Class Theme
 */
class Theme extends BaseSql implements Listable
{
    protected $id;
    protected $name;
    protected $directory;
    protected $is_selected;
    protected $version;
    protected $author;
    protected $description;

    /**
     * Theme constructor.
     * @param int $id
     * @param null $name
     * @param null $directory
     * @param bool $is_selected
     * @param null $version
     * @param null $author
     * @param null $description
     */
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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @param $directory
     */
    public function setDirectory($directory)
    {
        $this->directory = $directory;
    }

    /**
     * @return mixed
     */
    public function isIsSelected()
    {
        return $this->is_selected;
    }

    /**
     * @param $is_selected
     */
    public function setIsSelected($is_selected)
    {
        $this->is_selected = $is_selected;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


    /**
     * @return array
     */
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
                    'Nom',
                    'Utilisé',
                    'Description',
                    'Autheur',
                    'Version',
                    'Action'
                ]
            ],
            Listable::LIST_ROWS => $this->getListData()
        ];
    }

    /**
     * @return array
     */
    public function getListData()
    {
        return [];
    }
}