<?php if (isset($menu)):
    $this->includeModal('list', $menu->getListConfig($configList), $configList);
endif;
