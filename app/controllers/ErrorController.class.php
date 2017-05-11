<?php

class ErrorController
{

    public function error404()
    {
        header('HTTP/1.1 404 Not Found');

        $view = new View('back', 'errors/404', 'error');
        $view->assign('errorCode', 404);
    }
}
