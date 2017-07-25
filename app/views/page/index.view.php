<?php if (isset($page)): ?>
    <?php $this->includeModal('list', $page->getListConfig($configList), $configList); ?>
<?php endif; ?>