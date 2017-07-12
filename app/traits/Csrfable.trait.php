<?php
trait Csrfable {
    public function check($token)
    {
        if(!Csrf::check($token)){
            Session::addError('Le serveur ne peut répondre à cette requete.');
            Helpers::redirectBack();
            die;
        }
    }
}
