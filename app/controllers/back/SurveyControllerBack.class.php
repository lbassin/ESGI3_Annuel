<?php

class SurveyControllerBack extends Controller
{
    public function saveAction($params = [], $multiple = false, $table = false)
    {
        $postData = $params[Routing::PARAMS_POST];
        $multiple = (isset($postData['answer'])) ? true : false;
        $idSurvey = parent::saveAction([Routing::PARAMS_POST => $postData], true);
        $survey = new Survey();
        $survey->populate(['id' => $idSurvey]);
        $survey->getSurvey_answer();
        if ($multiple == true) {
            $count = count($postData['answer']) - 1;
            foreach ($postData['answer'] as $key => $answers) {
                $answers['survey'] = $idSurvey;
                parent::saveAction([
                    Routing::PARAMS_POST => $answers,
                ], $count != $key, 'survey_answer');
            }
        } else {
            if ($survey->survey_answers() != null) {
                foreach ($survey->survey_answers() as $survey_answer) {
                    $survey_answer->delete(['id' => $survey_answer->id()]);
                }
            }
            Session::addSuccess("Votre " . lcfirst(str_replace(self::CLASS_CONTROLLER, '', lcfirst(get_called_class()))) . " a bien été enregistré");
            Helpers::redirect(Helpers::getAdminRoute(str_replace(self::CLASS_CONTROLLER, '', lcfirst(get_called_class()))));
        }
    }
}
