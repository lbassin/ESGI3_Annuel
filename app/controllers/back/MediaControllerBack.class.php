<?php

class MediaControllerBack extends Controller
{
    public function saveAction($params = []) {
        $params[Routing::PARAMS_POST]['user'] = $_SESSION['id'];
        parent::saveAction($params);
    }

}
