<?php

class LoginControllerBack
{

    public function indexAction($params)
    {
        $view = new View('back', 'index', 'login');
    }

    public function loginAction($params)
    {
        if (empty($params['email']) || empty($params['password'])) {
            die('Formulaire de connexion non remplis correctement');
        }
        $user = new User();
        $user->populate(['email' => $params['email']]);
        if ($user->getId() && Hash::check($params['password'], $user->getPassword())) {
            if ($user->getStatus() != 0) {
                Csrf::generate();
                $_SESSION['id'] = $user->getId();
                var_dump($_SESSION);
                $view = new View('back', 'index', 'admin');
            }
        } else {
            die('Connexion impossible');
        }
    }

    public function ForgetAction($params)
    {
        $user = new User();
        $user->populate(['email' => $params['email'], 'password' => $params['password']]);

        if ($user->getId() < 0) {
            die('Connexion impossible');
        } else {
            // User existe
            if ($user->getStatus() != 0) {
                // User actif
                $view = new View('back', 'index', 'admin');
                // Lancer la session d'authentification
                //Csrf::generate();
            }
        }
    }

    public function logoutAction()
    {
        session_unset();
        session_destroy();
        $view = new View('back', 'index', 'login');
    }

    public function unsubscribeAction()
    {
        $user = new User($_SESSION['id']);
        // Status 0 means that the user is no longer active
        $user->status = 0;
        $user->update();
        $view = new View('back', 'index', 'admin');
    }
}
