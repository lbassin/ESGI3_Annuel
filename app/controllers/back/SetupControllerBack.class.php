<?php

class SetupControllerBack
{

    public function indexAction()
    {
        $view = new View('back', 'setup/index', 'setup');
    }

    public function checkAction()
    {
        $view = new View('back', 'setup/check', 'setup');
    }

    public function infosAction()
    {
        $view = new View('back', 'setup/infos', 'setup');
    }

}
