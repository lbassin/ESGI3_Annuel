<?php
trait Rolable
{
    public function checkRole($data, $className)
    {
        if ($_SESSION['role'] != 1) {
            if ($className == 'User') {
                if (!empty($data['id'])) {
                    if ($data['id'] != $_SESSION['id']) {
                        echo 'bug';
                    }
                } else {
                    Session::addError("Vous n'avez pas les droits pour effectuer cette action !");
                }
            } elseif ($_SESSION['role'] == 2) {
                Role::checkRedac($className);
            } elseif ($_SESSION['role'] == 3) {
                Role::checkUser($className);
            } elseif ($_SESSION['role'] > 3) {
                Session::addError("Vous n'avez pas les droits pour effectuer cette action !");
            }
        }
    }
}