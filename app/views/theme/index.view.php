<?php if (isset($theme)):
    $this->includeModal('list', $theme->getListConfig($configList), $configList);
endif;