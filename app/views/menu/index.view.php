<?php if (isset($menu)): ?>
    <?php $this->includeModal('list', $menu->getListConfig(), $configList); ?>
<?php endif; ?>

<br>
<a href="#">Supprimer les Menu séléctionnés</a>
