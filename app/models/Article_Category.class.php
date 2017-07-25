<?php

class Article_Category extends Sql
{
    protected $id;
    protected $id_article;
    protected $id_category;

    public function __construct($data = '')
    {
        parent::__construct($data);
    }
}