<?php
class Survey extends Sql implements Listable, Editable
{
    protected $id;
    protected $question;

    public function __construct($data = '')
    {
        $this->hasMany(['survey_answer', 'article']);
        parent::__construct($data);
    }

    public function validate()
    {
        return [
            'question' => [
                'required' => true,
                'min' => 1,
                'max' => 255,
                'unique' => true,
            ]
        ];
    }

    public function getListConfig()
    {
        return [
            Listable::LIST_STRUCT => [
                Listable::LIST_TITLE => 'Survey',
                Listable::LIST_NEW_LINK => Helpers::getAdminRoute('survey/new'),
                Listable::LIST_EDIT_LINK => Helpers::getAdminRoute('survey/edit'),
                Listable::LIST_HEADER => [
                    '',
                    'ID',
                    'Question',
                    'Nb vote',
                    'Article',
                    'Action'
                ]
            ],
            Listable::LIST_ROWS => $this->getListData()
        ];
    }

    public function getListData($configList = null)
    {
        $surveys = $this->getAll();
        $listData = [];
        /** @var User $user */
        foreach ($surveys as $survey) {
            $survey->getSurvey_answer();
            $survey->getArticle();
            $surveyData = [
                [
                    'type' => 'checkbox',
                    'value' => ''
                ],
                [
                    'type' => 'text',
                    'value' => $survey->id()
                ],
                [
                    'type' => 'text',
                    'value' => $survey->question()
                ],
                [
                    'type' => 'text',
                    'value' => count($survey->survey_answers())
                ],
                [
                    'type' => 'text',
                    'value' => count($survey->articles())
                ],
                [
                    'type' => 'action',
                    'id' => $survey->id()
                ]
            ];
            $listData[] = $surveyData;
        }
        return $listData;
    }

    public function getFormConfig()
    {
        return [
            Editable::FORM_STRUCT => [
                Editable::FORM_METHOD => 'post',
                Editable::MODEL_URL => Helpers::getAdminRoute('survey'),
                Editable::MODEL_ID => $this->id(),
                Editable::FORM_SUBMIT => 'Save'
            ],
            Editable::FORM_GROUPS => [
                [
                    Editable::GROUP_LABEL => 'Survey',
                    Editable::GROUP_FIELDS => [
                        'id' => [
                            'type' => 'hidden',
                            'value' => $this->id()
                        ],
                        'question' => [
                            'type' => 'text',
                            'label' => 'Label',
                            'value' => $this->question()
                        ]
                    ]
                ],
                [
                    Editable::GROUP_LABEL => 'Answer',
                    Editable::GROUP_FIELDS => [
                        'preview' => [
                            'type' => 'widget',
                            'id' => 'survey/new',
                            'data' => json_encode($this->getAnswers())
                        ]
                    ]
                ]
            ]
        ];
    }

    public function getAnswers()
    {
        $this->getSurvey_answer();
        if ($this->survey_answers() != null) {
            $dataAnswer = [];
            foreach ($this->survey_answers() as $item) {
                $dataAnswer[$item->id()]['answer'] = $item->answer();
            }
            return $dataAnswer;
        }
        return [];
    }
}