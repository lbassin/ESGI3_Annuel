<h1>Ajouter une categorie</h1>

<?php
if (isset($category)) {
    $this->includeModal('form', $category->getFormConfig());
}
