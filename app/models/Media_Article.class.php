<?php
class Media_Article extends BaseSql
{
    protected $id;
    protected $id_media;
    protected $id_article;

    public function __construct(
        $id = -1,
        $id_media = null,
        $id_article = null
    )
    {
        $this->setId($id);
        $this->setIdMedia($id_media);
        $this->setIdArticle($id_article);

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

    public function getIdArticle()
    {
        return $this->id_article;
    }

    public function setIdArticle($id_article)
    {
        $this->id_article = $id_article;
    }


}