<?php

class ArticleCategory
{
    protected $id;
    protected $id_article;
    protected $id_category;

    public function __construct(
        $id = -1,
        $id_article = null,
        $id_category = null
    )
    {
        $this->setId($id);
        $this->setIdArticle($id_article);
        $this->setIdCategory($id_category);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdArticle()
    {
        return $this->id_article;
    }

    public function setIdArticle($id_article)
    {
        $this->id_article = $id_article;
    }

    public function getIdCategory()
    {
        return $this->id_category;
    }

    public function setIdCategory($id_category)
    {
        $this->id_category = $id_category;
    }


}