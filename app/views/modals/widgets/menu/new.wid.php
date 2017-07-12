<div class="widget menu_new">
    <div class="hidden" id="field-line-example">
        <div class="field-line">
            <label for="input-label-">Label</label>
            <input type="text" class="input-label" id="input-label-">
            <label for="input-url-">Lien</label>
            <input type="text" class="input-url" id="input-url-">
            <input type="hidden" class="input-id">
        </div>
    </div>
    <div id="dropdown-config"></div>
    <div id="add-sublink"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Ajout sous menu</div>
</div>

<script>
    var data = '<?php echo $widgetData; ?>';
</script>
<script src="<?php echo Helpers::getAsset('js/modals/widgets/menu.js') ?>"></script>
