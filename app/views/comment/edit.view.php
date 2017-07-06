<h1>Editer un commentaire</h1>
<small><a href="<?php echo Helpers::getAdminRoute('comment'); ?>">Back</a></small>
<small><a href="">Supprimer</a></small>

<?php
if (isset($comment)) {
    $this->includeModal('form', $comment->getFormConfig());
}
