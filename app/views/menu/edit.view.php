<h1>Edition d'un lien du menu</h1>

<?php
if (isset($menu)) {
    $this->includeModal('form', $menu->getFormConfig());
}