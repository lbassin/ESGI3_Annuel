<?php

class ErrorController
{

    public function error404()
    {
        //header('HTTP/1.1 404 Not Found');

        $view = new View('back', 'errors/404', 'error');
        $view->assign('errorCode', 404);
    }

    public function error500(){
        //header('HTTP/1.1 500 Internal Server Error');

        $view = new View('back', 'errors/500', 'error');
        $view->assign('errorCode', 500);
    }

    public function handleException($ex)
    {
        //header('HTTP/1.1 500 Internal Server Error');

        if (defined('DEBUG_MODE') && DEBUG_MODE === true){
            $view = new View('back', 'errors/exception', 'error');
            $view->assign('exception', $ex);
        }else{
            $this->error500();
        }
    }
}
