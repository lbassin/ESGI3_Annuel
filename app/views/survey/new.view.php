<h1>Nouveau sondage</h1>

<?php if(isset($survey)):
    $this->includeModal('form', $survey->getFormConfig());
endif;
