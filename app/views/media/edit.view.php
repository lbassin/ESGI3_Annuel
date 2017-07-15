<h1>Editer un media</h1>

<?php
if (isset($media)) {
    $this->includeModal('form', $media->getFormConfig());
    echo $media->display();
}
