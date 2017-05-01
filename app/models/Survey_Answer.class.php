<?php
class Survey_Answer extends BaseSql
{
    protected $id;
    protected $answer;
    protected $id_survey;


    public function __construct(
        $id = -1,
        $answer = null,
        $id_survey = null
    )
    {
        $this->setId($id);
        $this->setAnswer($answer);
        $this->setIdSurvey($id_survey);

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

    public function getAnswer()
    {
        return $this->answer;
    }

    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    public function getIdSurvey()
    {
        return $this->id_survey;
    }

    public function setIdSurvey($id_survey)
    {
        $this->id_survey = $id_survey;
    }

}