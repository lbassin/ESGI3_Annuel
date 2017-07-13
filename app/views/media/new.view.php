<h1>Ajout d'une nouvelle image</h1>

<?php
if (isset($media)) {
    $this->includeModal('form', $media->getFormConfig());
}
