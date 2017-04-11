<?php
class Survey extends BaseSql
{
    protected $id;
    protected $ask;
    protected $id_article;

    public function __construct(
        $id = -1,
        $ask = null,
        $id_article = null
    )
    {
        $this->setId($id);
        $this->setAsk($ask);
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

    public function getAsk()
    {
        return $this->ask;
    }

    public function setAsk($ask)
    {
        $this->ask = $ask;
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