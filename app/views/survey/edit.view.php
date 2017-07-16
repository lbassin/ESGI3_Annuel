<h1>Edition d'un lien du menu</h1>

<?php
if (isset($survey)) {
    $this->includeModal('form', $survey->getFormConfig());
}