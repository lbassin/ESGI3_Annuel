<h1>Nouvel utilisateur</h1>
<small><a href="<?php echo Helpers::getAdminRoute('user'); ?>">Back</a></small>

<?php
if (isset($user)) {
    $this->includeModal('form', $user->getFormConfig());
}
