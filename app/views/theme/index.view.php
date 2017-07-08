<?php if (isset($theme)): ?>
    <?php $this->includeModal('list', $theme->getListConfig()); ?>
<?php endif; ?>