<?php
class Comment extends BaseSql
{
    protected $id;
    protected $content;
    protected $id_article;
    protected $id_user;

    public function __construct(
        $id = -1,
        $content = null,
        $id_article = null,
        $id_user = null
    )
    {
        $this->setId($id);
        $this->setContent($content);
        $this->setIdArticle($id_article);
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

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getIdArticle()
    {
        return $this->id_article;
    }

    public function setIdArticle($id_article)
    {
        $this->id_article = $id_article;
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