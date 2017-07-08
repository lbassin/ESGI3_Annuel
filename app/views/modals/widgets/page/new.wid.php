<div class="widget page_new">
    <div class="left">

    </div>
    <div class="middle">
        <div class="preview">

        </div>
        <button>Preview</button>
    </div>
    <div class="right">
        <div id="btnAddComponent" class="action-popin" data-target="popin-addComponent"><i class="fa fa-plus"
                                                                                           aria-hidden="true"></i> Add
            new component
        </div>
    </div>
</div>

<div id="popin-addComponent" class="popin-container hidden">
    <div class="popin-overlay">
    </div>
    <div class="popin-content">
        <div class="grid-templates">
            <h3>Selectionnez le template qui vous plait</h3>
            <div>
            </div>
        </div>
        <div class="template-config hidden">
            <div id="addComponent-errors" class="popin-errors hidden"></div>
            <div class="ajax-content"></div>
            <div class="popin-content-footer">
                <button class="validate-component">Valider</button>
            </div>
        </div>
    </div>
</div>

<script>
    var dataSession = [];
    <?php foreach (Session::getFormData('components') as $component): ?>
        dataSession.push(JSON.parse(<?php echo json_encode($component); ?>));
    <?php endforeach; ?>

    dataSession = JSON.stringify(dataSession);
</script>

<script>
    var urlComponent = '<?php echo Helpers::getAdminRoute('component/component'); ?>';
    var urlValidate = '<?php echo Helpers::getAdminRoute('component/validate'); ?>';
    var data = '<?php echo isset($widgetData) ? json_encode($widgetData) : ''; ?>';

    if (JSON.parse(dataSession).length > 0) {
        console.log(dataSession.length);
        var data = dataSession;
    }
</script>
