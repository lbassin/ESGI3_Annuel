<?php

if (isset($user)) {
    $this->includeModal('form', $user->getFormConfig());
}
