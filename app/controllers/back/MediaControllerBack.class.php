<?php

class MediaControllerBack extends Controller
{
    public function saveAction($params = []) {
        $params[Routing::PARAMS_POST]['user'] = $_SESSION['id'];
        parent::saveAction($params);
    }

    public function newAction(){
        $view = new View('back', 'media/new', 'admin');

        $media = new Media();
        $view->assign('media', $media);
    }

    public function editAction($params){
        $params = $params['url'];
        if (!isset($params[0])) {
            Session::addError('Missing Id');
            Helpers::redirectBack();
        }
        $mediaId = $params[0];

        $view = new View('back', 'media/edit', 'admin');

        $media = new Media();
        $media->populate(['id' => $mediaId]);

        if ($media->getId() == null) {
            Session::addError('Media ' . $mediaId . ' not found');
            Helpers::redirectBack();
        }

        $view->assign('media', $media);
    }

    public function saveAction($params) {
        $media = new Media();
        $media->validate($params);
        if (count(Session::getErrors()) > 0) {
            Helpers::redirectBack();
        }

        $params['post']['path'] = $media->upload($params['files']);
        $params['post']['type'] = 'image';
        $params['post']['extension'] = $media->getExensionFromFile($params['files']['image']['name']);

        $media->fill($params['post']);
        $media->setUser($_SESSION['id']);

        try {
            $media->save();
        } catch (Exception $ex) {
            Session::addError($ex->getMessage());
            Helpers::redirectBack();
        }

        Session::addSuccess('Media successfully saved');
        Helpers::redirect(Helpers::getAdminRoute('media'));
    }

    public function deleteAction($params = []) {
        $ids = $params['post']['id'];
        foreach ($ids as $key => $id) {
            $media = new Media();
            $media->fill(['id' => $id]);
            try {
                $media->delete();
            } catch (Exception $ex) {
                Session::addError($ex->getMessage());
                Helpers::redirectBack();
            }
        }
        Session::addSuccess('Medias successfully deleted');
        Helpers::redirect(Helpers::getAdminRoute('media'));
    }

    public function previewAction($params) {

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
