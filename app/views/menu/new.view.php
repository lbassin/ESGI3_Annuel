<h1>Nouveau menu</h1>

<?php if(isset($menu)): ?>
    <?php $this->includeModal('form', $menu->getFormConfig()); ?>
<?php endif; ?>
