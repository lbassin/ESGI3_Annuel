<?php if (isset($category)):
    $this->includeModal('list', $category->getListConfig($configList), $configList);
endif; ?>
1
