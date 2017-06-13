<?php
class Survey extends BaseSql
{
    protected $id;
    protected $question;

    public function __construct()
    {
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

    public function getAllAsOptions()
    {
        $surveys = $this->getAll();

        $data = [];
        foreach ($surveys as $survey) {
            if (!empty($survey->getQuestion())) {
                $data[$survey->getQuestion()] = $survey->getId();
            }
        }

        return $data;
    }

}