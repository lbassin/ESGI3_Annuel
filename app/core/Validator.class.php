<?php

/**
 * Class Validator
 */
class Validator
{
    private $translation = [
        'required' => 'Le champs {{name}} est obligatoire',
        'min' => 'La taille minimun du champs {{name}} est de {{value}}',
        'max' => 'La taille maximale du champs {{name}} est de {{value}}'
    ];

    /**
     * @param $data
     * @param $constraints
     * @return array
     */
    public function validate($data, $constraints)
    {
        $errors = [];
        foreach ($constraints as $inputName => $constraint) {
            if (!isset($data[$inputName]) && $constraint['required']) {
                $errors[$inputName]['required'] = $constraint['required'];
                continue;
            }
            unset($constraint['required']);

            if (!isset($data[$inputName])) {
                continue;
            }

            foreach ($constraint as $function => $value) {
                if (!method_exists($this, $function)) {
                    continue;
                }

                if (!$this->$function($data[$inputName], $value)) {
                    $errors[$inputName][$function] = $value;
                }
            }

        }

        return $this->formatErrors($errors);
    }

    /**
     * @param array $errors
     * @return array
     */
    public function formatErrors(array $errors)
    {
        $displayError = [];
        foreach ($errors as $name => $inputErrors) {
            foreach ($inputErrors as $error => $value) {
                $message = $this->translation[$error];

                $message = str_replace('{{name}}', $name, $message);
                $message = str_replace('{{value}}', $value, $message);

                $displayError[] = $message;
            }
        }

        return ['errors' => $displayError];
    }

    /**
     * @param $input
     * @param $constraint
     * @return bool
     */
    private function required($input, $constraint)
    {
        return false;
    }

    /**
     * @param $input
     * @param $constraint
     * @return bool
     */
    private function min($input, $constraint)
    {
        return strlen($input) >= $constraint;
    }

    /**
     * @param $input
     * @param $constraint
     * @return bool
     */
    private function max($input, $constraint)
    {
        return strlen($input) <= $constraint;
    }
}
