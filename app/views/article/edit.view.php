<h1>Editer un article</h1>

<?php
if (isset($article)) {
    $this->includeModal('form', $article->getFormConfig());
}
?>

