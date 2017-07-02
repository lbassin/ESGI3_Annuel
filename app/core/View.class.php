<?php

class View
{
    protected $currentTheme;
    protected $type;
    protected $view;
    protected $template;
    protected $data = [];
    protected $notifications = [];

    public function __construct($type, $view = 'index', $template = 'frontend')
    {
        $this->currentTheme = 'default';
        $this->type = $type;
        $this->setView($view);
        $this->setTemplate($template);
    }

    public function setView($view)
    {
        if ($this->type == 'front') {
            $path = 'themes/templates/' . $this->currentTheme . '/views/' . $view . '.view.php';
        } elseif ($this->type == 'back') {
            $path = 'app/views/' . $view . '.view.php';
        } else {
            throw new Exception('erreur');
        }

        if (!file_exists($path)) {
            throw new Exception('View not found');
        }

        $this->view = $view . '.view.php';
    }

    public function setTemplate($template)
    {
        if($this->type == 'front'){
            $path = 'themes/templates/' . $this->currentTheme . '/' . $template . '.temp.php';
        }elseif($this->type == 'back'){
            $path = 'app/views/' . $template . '.temp.php';
        }else{
            throw new Exception('erreur');
        }

        if (!file_exists($path)) {
            throw new Exception('Template not found');
        }

        $this->template = $path;
    }

    public function assign($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function includeModal($modal, $config, $pagination = [])
    {
        $filename = 'app/views/modals/' . $modal . '.mod.php';
        if (!file_exists($filename)) {
            throw new Exception("Le modal n'existe pas");
        }
        include $filename;
    }

    public function getErrors()
    {
        $errors = Session::getErrors();
        Session::resetErrors();

        return $errors;
    }

    public function getSuccess()
    {
        $success = Session::getSuccess();
        Session::resetSuccess();

        return $success;
    }

    public function __destruct()
    { // = renderer
        extract($this->data);

        include $this->template;
    }

}
