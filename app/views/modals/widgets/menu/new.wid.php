<div class="widget menu_new">
    <div class="hidden" id="field-line-example">
        <div class="field-line">
            <label for="input-label-">Label</label>
            <input type="text" class="input-label" id="input-label-">
            <label for="input-url-">Lien</label>
            <input type="text" class="input-url" id="input-url-">
            <input type="hidden" class="input-id">
            <div class="remove-sublink button"><i class="fa fa-remove" aria-hidden="true"></i>&nbsp;Supprimer</div>
        </div>
    </div>
    <div id="dropdown-config"></div>
    <div class="button" id="add-sublink"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Ajout sous menu</div>
</div>

<script>
    <?php unset($widgetData['name']); ?>
    var data = '<?php echo json_encode($widgetData); ?>';
</script>
<script src="<?php echo Helpers::getAsset('js/modals/widgets/menu.js') ?>"></script>
