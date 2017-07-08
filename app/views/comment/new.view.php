<h1>Ajouter un commentaire</h1>

<?php
if (isset($comment)) {
    $this->includeModal('form', $comment->getFormConfig());
}
