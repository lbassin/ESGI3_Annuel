<h1>Ajout d'une nouvelle image</h1>
<small><a href="<?php echo Helpers::getAdminRoute('media'); ?>">Back</a></small>

<?php
if (isset($media)) {
    $this->includeModal('form', $media->getFormConfig());
}
