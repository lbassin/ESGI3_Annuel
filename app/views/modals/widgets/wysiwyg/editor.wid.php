<?php
$dataForm = Session::getFormData();
$dataForm['currentEditor'] = isset($dataForm['currentEditor']) ? $dataForm['currentEditor'] : 0;
$editorValue = isset($dataForm['editor' . $dataForm['currentEditor']]) ? $dataForm['editor' . $dataForm['currentEditor']] : '';
$dataForm['currentEditor'] += 1;
Session::setFormData($dataForm);
?>
<div class="wysiwyg-editor" data-call-script="initWysiwygEditor"
     data-old-value='<?php echo $editorValue; ?>'></div>
<input type="hidden" name="editor" id="editor-input" value="">
