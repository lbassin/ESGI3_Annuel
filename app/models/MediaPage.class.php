<?php
class MediaPage extends BaseSql
{
    protected $id;
    protected $id_media;
    protected $id_page;

    public function __construct(
        $id = -1,
        $id_media = null,
        $id_page = null
    )
    {
        $this->setId($id);
        $this->setIdMedia($id_media);
        $this->setIdPage($id_page);

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

    public function getIdMedia()
    {
        return $this->id_media;
    }

    public function setIdMedia($id_media)
    {
        $this->id_media = $id_media;
    }

    public function getIdPage()
    {
        return $this->id_page;
    }

    public function setIdPage($id_page)
    {
        $this->id_page = $id_page;
    }


}