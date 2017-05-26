<?php if (isset($user)): ?>
    <?php $this->includeModal('list', $user->getListConfig()); ?>
<?php endif; ?>
