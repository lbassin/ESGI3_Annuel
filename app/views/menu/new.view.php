<h1>Nouveau menu</h1>
<input type="hidden" value='<?php echo $params["jsonsublink"]; ?>' id="json-sublink">
<input type="hidden" value='<?php echo $params["nbSublink"]; ?>' id="nb-sublink">

<?php if(isset($menu)): ?>
    <?php $this->includeModal('form', $menu->getFormConfig()); ?>
<?php endif; ?>
