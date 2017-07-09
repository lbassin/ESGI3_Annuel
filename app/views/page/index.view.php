<?php if (isset($page)): ?>
    <?php $this->includeModal('list', $page->getListConfig(), $configList); ?>
<?php endif; ?>