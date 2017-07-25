<h1>Editer une catégorie</h1>

<?php
if (isset($category)) {
    $this->includeModal('form', $category->getFormConfig());
}
