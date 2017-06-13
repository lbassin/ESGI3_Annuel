<h1>Editer utilisateur</h1>

<?php
if (isset($user)) {
    $this->includeModal('form', $user->getFormConfig());
}
