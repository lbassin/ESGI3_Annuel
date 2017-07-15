<?php

/**
 * Class Validator
 */
class Validator
{
    const MEDIA_ALLOWED_EXT = ['png', 'jpg', 'jpeg', 'gif', 'bmp', 'ttf'];
    private $data;
    private $className;

    function __construct($data, $className = null)
    {
        $this->className = $className;
        $this->data = $data;
    }

    public function validate(array $constraints)
    {
        foreach ($constraints as $column => $constraint) {
            foreach ($constraint as $rule => $inputValue) {
                if (method_exists($this, $rule)) {
                    $this->$rule($column, $this->data[$column], $inputValue);
                }
            }
        }
    }

    /**
     * @param $inputName
     * @param $inputValue
     * @param $constraint
     */
    private function required($inputName, $inputValue, $constraint)
    {
        (empty($inputValue) && $constraint == true) ? Session::addError('Le champ ' . $inputName . ' est requis !') : '';
    }

    /**
     * @param $inputName
     * @param $inputValue
     * @param $constraint
     */
    private function min($inputName, $inputValue, $constraint)
    {
        (strlen($inputValue) <= $constraint) ? Session::addError('Le champ ' . $inputName . ' est trop court, limite : ' . $constraint . ' minimum !') : '';
    }

    /**
     * @param $inputName
     * @param $inputValue
     * @param $constraint
     */
    private function max($inputName, $inputValue, $constraint)
    {
        (strlen($inputValue) >= $constraint) ? Session::addError('Le champ ' . $inputName . ' est trop long, limite : ' . $constraint . ' maximum !') : '';
    }

    /**
     * @param $inputName
     * @param $inputValue
     * @param $constraint
     */
    private function email($inputName, $inputValue, $constraint)
    {
        (!filter_var($inputValue, FILTER_VALIDATE_EMAIL) && $constraint == true) ? Session::addError('Le champ ' . $inputName . ' doit être sous format email !') : '';
    }


    /**
     * @param $inputName
     * @param $inputValue
     * @param $constraint
     * @return bool
     */
    private function unique($inputName, $inputValue, $constraint)
    {
        if (!$this->className) {
            Session::addError('Class name null');
            return false;
        }

        /** @var BaseSql $class */
        $class = new $this->className();
        $found = $class->getAll([$inputName => $inputValue]);

        if (isset($this->data['id']) && count($found) == 1 && $found[0]->id() == $this->data['id']) {
            return true;
        } else if (count($found) == 0) {
            return true;
        } else {
            Session::addError('Le champ ' . $inputName . ' doit être unique !');
            return false;
        }
    }

    private function whiteList($inputName, $inputValue, $constraint) {
        (!in_array($inputValue, self::MEDIA_ALLOWED_EXT)) ? Session::addError('L\'extension n\'est pas autorisée') : '';
    }

    private function trueMedia($inputName, $inputValue, $constraint) {
        if (!file_exists($inputValue)) {
            Session::addError('Le fichier uploadé n\'existe pas !');
        }
        $extension = new SplFileInfo($inputValue);
        if (!in_array($extension->getExtension(), self::MEDIA_ALLOWED_EXT)) {
            Session::addError('L\'extension n\'est pas autorisée');
        }
    }
}
