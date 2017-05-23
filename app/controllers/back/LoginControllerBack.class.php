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

    public function ForgetAction($params)
    {
        if (empty($params['post']) && !$this->validateForgetData($params['post'])) {
            Helpers::error403(['error' => 'Missing Data']);
        }
        $params = $params['post'];

        $user = new User();
        $user->populate(['email' => $params['email']]);

        // TODO : Send email
    }

    private function validateForgetData($params)
    {
        if (empty($params['email'])) {
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

}
