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
}
