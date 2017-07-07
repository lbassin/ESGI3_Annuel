<?php

class LoginControllerBack
{

    public function indexAction($params)
    {
        Csrf::generate();
        $view = new View('back', 'login/index', 'login');
        $view->assign('csrfToken', Session::getToken());
    }

    public function loginAction($params)
    {
        if (empty($params['post']) && !$this->validateLoginData($params['post'])) {
            Helpers::error403(['error' => 'Missing Data']);
        }
        $params = $params['post'];

        $user = new User();
        $user->populate(['email' => $params['email']]);

        if ($user->getId() && Hash::check($params['password'], $user->getPassword()) && $user->getStatus() != 0) {
            $_SESSION['id'] = $user->getId();

            $message = json_encode(['success' => true, 'redirectTo' => Helpers::getAdminRoute('index')]);
            echo $message;
        } else {
            Helpers::error403(['error' => 'Wrong Credentials']);
        }
    }

    private function validateLoginData($params)
    {
        if (empty($params['email']) || empty($params['password']) || !Csrf::check($params['token'])) {
            return false;
        }

        return true;
    }

    public function logoutAction()
    {
        session_unset();
        session_destroy();
        Helpers::redirect('/' . BASE_PATH);
    }

    public function resetPasswordAction($params)
    {
        if (isset($params['post']['email'])) {
            $user = new User();
            $user->populate(['email' => $params['post']['email']]);

            if(! is_null($user->getId())) { // TODO
                ob_start();
                $resetPassword = new Reset_Password();
                $token = $resetPassword->generateToken();
                $resetPassword->setToken($token);
                $resetPassword->setUserId($user->getId());

                $resetPassword->save();

                $view = new View('front', 'index', 'mail');
                $view->assign('pseudo', $user->getPseudo());
                $view->assign('token', $token);
                $view->assign('port', ($_SERVER['SERVER_PORT'] == 80 ? "http" : "https") . "://");
                $view = null;
                $renderedView = ob_get_clean();

                $mail = new Mail($params['post']['email'], 'Qwarkz - Réinitialisation de votre mot de passe', $renderedView);
                $mail->send();
            } else {
                echo json_encode(['success' => false, 'message' => "Aucun compte n'est rattaché<br>à cet email"]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Une erreur est survenue']);
        }
    }

    public function resetAction() {
        $resetPassword = new Reset_Password();
        $tmp = explode('/', $_SERVER['REQUEST_URI']);
        $resetPassword->populate(['token' => end($tmp)]);
        if(! is_null($resetPassword->getId())) {
            Csrf::generate();
            $view = new View('back', 'login/reset', 'login');
            $view->assign('csrfToken', Session::getToken());
        } else {
            Helpers::error404();
        }
    }

    public function validateResetPasswordAction($params) {
        if (isset($params['post']['password'])) {
            $resetPassword = new Reset_Password();
            $resetPassword->populate(['token' => $params['post']['token']]);

            $user = new User();
            $user->populate(['id' => $resetPassword->getUserId()]);

            $user->setPassword($params['post']['password']);
            $user->save();

            $resetPassword->delete();

            $message = json_encode(['success' => true, 'message' => 'Votre mot de passe a été réinitialisé<br>Vous allez être redirigé']);
        } else {
            $message = json_encode(['success' => false, 'message' => 'Une erreur est survenue']);
        }
        echo $message;
    }
}
