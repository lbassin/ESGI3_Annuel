<?php

class MediaControllerBack extends Controller
{
    public function saveAction($params = []) {
        $params[Routing::PARAMS_POST]['user'] = $_SESSION['id'];
        $params[Routing::PARAMS_POST]['type'] =  $params['files']['image']['type'];
        $params[Routing::PARAMS_POST]['extension'] = substr($params['files']['image']['type'], strpos($params['files']['image']['type'], "/") + 1);

        if (! empty($params[Routing::PARAMS_POST]['path'])) {
            $name = uniqid();
            rename($params[Routing::PARAMS_POST]['path'], FILE_UPLOAD_PATH . "/" . $name . "." . $params[Routing::PARAMS_POST]['extension']);
            $params[Routing::PARAMS_POST]['path'] = FILE_UPLOAD_PATH . "/" . $name . "." . $params[Routing::PARAMS_POST]['extension'];
        }

        parent::saveAction($params);
    }

    public function previewAction($params)
    {
        if (isset($params['post']['nom'])) {
            if (count(Session::getErrors()) > 0) {
                Helpers::redirectBack();
            }

            $data = $params['post']['image'];
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);

            file_put_contents(FILE_UPLOAD_PATH . "/tmp/" . $params['post']['nom'], $data);
            $message = json_encode(['success' => true, 'image' => $params['post']['nom'], 'base_path' => BASE_PATH]);
        } else {
            $message = json_encode(['success' => false]);
        }

        echo $message;
    }
}
