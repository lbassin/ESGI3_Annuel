<?php

/**
 * Class Validator
 */
class Validator
{
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

        $class = new $this->className();
        $class->populate([$inputName => $inputValue]);
        $getter = 'get' . ucfirst($inputName);
        (!empty($class->$getter()) && $constraint == true) ? Session::addError('Le champ ' . $inputName . ' doit être unique !') : '';
    }
}
