<?php if (isset($user)): ?>
    <?php $this->includeModal('list', $user->getListConfig()); ?>
<?php endif; ?>

<br>
    <a href="#">Supprimer les utilisateurs selectionnés</a>