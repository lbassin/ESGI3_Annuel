<div class="field-line">
    <label class="" for="input-image">Media :</label>
    <input type="file" name="<?php echo $widgetData['name']; ?>" accept="image/*">
</div>

<div id="image-preview-<?php echo $widgetData['name']; ?>"></div>

<script>
    var mediaPreview = '<?php echo Helpers::getAdminRoute('media/preview'); ?>';
</script>
<div data-call-script="initMediaUploader"></div>
