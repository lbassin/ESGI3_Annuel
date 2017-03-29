<?php

class View
{
    protected $currentTheme;
    protected $type;
    protected $view;
    protected $template;
    protected $data = [];

    public function __construct($type, $view = 'index', $template = 'frontend')
    {
        $this->currentTheme = 'default';
        $this->type = $type;
        $this->setView($view);
        $this->setTemplate($template);
    }

    public function setView($view)
    {
        $path = 'app/views/' . $view . '.view.php';
        if (!file_exists($path)) {
            die('View not found');
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
            die('erreur');
        }

        if (!file_exists($path)) {
            die('Template not found');
        }

        $this->template = $path;
    }

    public function assign($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __destruct()
    { // = renderer
        extract($this->data);


        include $this->template;
    }

}
