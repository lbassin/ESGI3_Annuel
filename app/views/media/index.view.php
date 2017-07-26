<?php if (isset($media)): ?>
    <?php $this->includeModal('list', $media->getListConfig($configList), $configList); ?>
<?php endif; ?>
