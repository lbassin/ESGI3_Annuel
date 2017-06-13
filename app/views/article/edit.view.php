<h1>Editer un article</h1>
<small><a href="<?php echo Helpers::getAdminRoute('article'); ?>">Back</a></small>
<small><a href="">Supprimer</a></small>

<?php
if (isset($article)) {
    $this->includeModal('form', $article->getFormConfig());
}
