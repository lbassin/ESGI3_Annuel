<?php
class Survey_Answer extends Sql
{
    protected $id;
    protected $answer;

    public function __construct($data = '')
    {
        $this->belongsTo(['survey']);
        $this->manyMany(['user']);
        parent::__construct($data);
    }

    public function validate()
    {
        return [
            'answer' => [
                'min' => 1,
                'max' => 255,
            ]
        ];
    }
}