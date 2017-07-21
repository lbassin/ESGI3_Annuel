<h1>Changer sa configuration</h1>

<?php
if (isset($config)) {
    $this->includeModal('form', $config->getFormConfig());
}
