<?php if (isset($survey)):
    $this->includeModal('list', $survey->getListConfig($configList), $configList);
endif;