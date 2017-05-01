<h1>Editer utilisateur</h1>
<small><a href="<?php echo Helpers::getAdminRoute('user'); ?>">Back</a></small>
<small><a href="">Supprimer</a></small>

<?php
if (isset($user)) {
    $this->includeModal('form', $user->getFormConfig());
}
