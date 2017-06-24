<div class="widget page_new">
    <div class="left">

    </div>
    <div class="middle">
        <div class="preview">

        </div>
    </div>
    <div class="right">
        <span class="action-popin" data-target="popin-addComponent"><i class="fa fa-plus" aria-hidden="true"></i> Add new component</span>
    </div>
</div>

<div id="popin-addComponent" class="popin-container hidden">
    <div class="popin-overlay">
    </div>
    <div class="popin-content">
        <div class="grid-templates">
            <h3>Selectionnez le template qui vous plait</h3>
            <div>
                <img src="<?php echo Helpers::getAsset('img/template_tmp.png'); ?>" alt="" class="template">
                <img src="<?php echo Helpers::getAsset('img/template_tmp.png'); ?>" alt="" class="template">
                <img src="<?php echo Helpers::getAsset('img/template_tmp.png'); ?>" alt="" class="template">
                <img src="<?php echo Helpers::getAsset('img/template_tmp.png'); ?>" alt="" class="template">
                <img src="<?php echo Helpers::getAsset('img/template_tmp.png'); ?>" alt="" class="template">
                <img src="<?php echo Helpers::getAsset('img/template_tmp.png'); ?>" alt="" class="template">
            </div>
        </div>
        <div class="template-config">
            <h3>Configuration</h3>
            <div class="field-line">
                <label for="template-input-title">Title</label>
                <input type="text" name="template-title" value="" placeholder="" id="template-input-title">
            </div>
            <button id="validate-component">Valider</button>
        </div>
    </div>
</div>