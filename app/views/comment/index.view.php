<?php if (isset($comment)): ?>
    <?php $this->includeModal('list', $comment->getListConfig(), $configList); ?>
<?php endif; ?>