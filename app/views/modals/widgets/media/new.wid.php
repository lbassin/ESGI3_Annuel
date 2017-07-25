<div class="field-line">
    <label class="" for="input-image">Media :</label>
    <input type="file" name="image" accept="image/*" id="input-image">
</div>

<div id="image-preview-final"></div>

<script>
    var mediaPreview = '<?php echo Helpers::getAdminRoute('media/preview'); ?>';
</script>
<div data-call-script="initMediaUploader"></div>