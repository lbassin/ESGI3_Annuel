<?php

class MediaControllerBack extends Controller
{
    public function previewAction($params)
    {
        if (isset($params['post']['nom'])) {
            if (count(Session::getErrors()) > 0) {
                Helpers::redirectBack();
            }

            $data = $params['post']['image'];
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);

            file_put_contents(FILE_UPLOAD_PATH . "/tmp/" . $params['post']['nom'], $data);
            $message = json_encode(['success' => true, 'image' => $params['post']['nom'], 'base_path' => BASE_PATH]);
        } else {
            $message = json_encode(['success' => false]);
        }

        echo $message;
    }
}
