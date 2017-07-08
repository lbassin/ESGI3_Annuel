<h1>Editer un commentaire</h1>

<?php
if (isset($comment)) {
    $this->includeModal('form', $comment->getFormConfig());
}
