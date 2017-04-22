<?php
class Survey extends BaseSql
{
    protected $id;
    protected $question;

    public function __construct(
        $id = -1,
        $question = null
    )
    {
        $this->setId($id);
        $this->setQuestion($question);

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

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion($question)
    {
        $this->question = $question;
    }

}