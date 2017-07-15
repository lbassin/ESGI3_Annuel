<div class="widget article_new">
    <div id="template-grid"></div>
</div>

<script>
    var savedTemplateId = '<?php echo $this->data['article']->getTemplateId(); ?>';
    var savedContent = '<?php echo addslashes(json_encode($this->data['article']->getContent())); ?>';
</script>

<script>
    var urlTemplates = '<?php echo Helpers::getAdminRoute('article/templates'); ?>';
    var formTemplate = '<?php echo Helpers::getAdminRoute('article/form'); ?>';
</script>
<script src="<?php echo Helpers::getAsset('js/modals/widgets/article.js') ?>"></script>
