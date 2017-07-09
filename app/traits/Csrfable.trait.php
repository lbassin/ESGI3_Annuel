<?php
trait Csrfable {
    public function check($token)
    {
        Csrf::check($token);
    }
}
