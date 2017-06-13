<?php /** @var View $this */ ?>
<?php if (isset($user)): ?>
    <?php $this->includeModal('list', $user->getListConfig($configList), $configList); ?>
<?php endif; ?>
