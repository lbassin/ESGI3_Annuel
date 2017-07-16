<div class="widget menu_new">
    <div class="hidden" id="field-line-example">
        <div class="field-line">
            <label for="input-answer-">Lien</label>
            <input type="text" class="input-answer" id="input-answer-">
            <input type="hidden" class="input-id">
            <div class="remove-sublink button"><i class="fa fa-remove" aria-hidden="true"></i>&nbsp;Supprimer</div>
        </div>
    </div>
    <div id="dropdown-config"></div>
    <div class="button" id="add-sublink"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Ajout sous menu</div>
</div>
<script>
    var data = '<?php echo $widgetData; ?>';
</script>
<script src="<?php echo Helpers::getAsset('js/modals/widgets/survey.js') ?>"></script>
