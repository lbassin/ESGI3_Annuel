<?php if (isset($page)): ?>
    <?php $this->includeModal('list', $page->getListConfig()); ?>
<?php endif; ?>