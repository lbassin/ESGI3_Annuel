<div id="form">
    <?php if (isset($config[Editable::FORM_STRUCT])): ?>
        <?php if (!isset($config[Editable::FORM_GROUPS])): ?>
            <?php $config[Editable::FORM_GROUPS] = []; ?>
        <?php endif; ?>

        <?php if (!isset($config[Editable::FORM_STRUCT]['hide_header'])): ?>
            <div id="menu">
                <div id="action">
                    <a href="<?php echo $config[Editable::FORM_STRUCT][Editable::MODEL_URL]; ?>"
                       class="button secondary">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Retour
                    </a>
                    <form method="post"
                          action="<?php echo $config[Editable::FORM_STRUCT][Editable::MODEL_URL] . 'delete'; ?>">
                        <input type="hidden" name="token" value="<?php echo Session::getToken(); ?>">
                        <input type="hidden" name="id"
                               value="<?php echo $config[Editable::FORM_STRUCT][Editable::MODEL_ID]; ?>">
                        <input type="submit" class="button secondary" value="Supprimer"/>
                    </form>
                    <a href="<?php echo isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '#undefined'; ?>"
                       class="button secondary">
                        Reset
                    </a>
                    <a href="#" class="button secondary" id="saveEditBtn">
                        Sauvegarder et editer
                    </a>
                    <a href="#" class="button primary" id="saveBtn">
                        Sauvegarder
                    </a>
                </div>
            </div>
        <?php endif; ?>
        <?php


        ?>
        <form name="model-form"
              method="<?php echo $config[Editable::FORM_STRUCT]['method']; ?>"
              action="<?php echo $config[Editable::FORM_STRUCT][Editable::MODEL_URL] . ((strpos($config[Editable::FORM_STRUCT][Editable::MODEL_URL], 'step') == false) ? 'save' : ''); ?>"
              class="<?php echo (isset($config[Editable::FORM_STRUCT]['class'])) ? $config[Editable::FORM_STRUCT]['class'] : ''; ?>"
            <?php echo(isset($config[Editable::FORM_STRUCT]['file']) ? 'enctype="multipart/form-data"' : 'text/plain'); ?>
        >
            <input type="hidden" name="token" value="<?php echo Session::getToken(); ?>">

            <?php foreach ($config[Editable::FORM_GROUPS] as $group): ?>
                <h2><?php echo $group['label']; ?></h2>

                <?php foreach ($group[Editable::GROUP_FIELDS] as $name => $attributs): ?>

                    <div class="field-line">
                        <?php if ($attributs['type'] == 'email' || $attributs['type'] == 'text' || $attributs['type'] == 'password'): ?>
                            <label class="<?php echo(isset($attributs['required']) ? 'required' : ''); ?>"
                                   for="<?php echo "input-" . $name; ?>"><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?></label>
                            <input
                                    type="<?php echo $attributs['type']; ?>"
                                    name="<?php echo $name; ?>"
                                    value="<?php echo !empty(Session::getFormData($name)) ?
                                        Session::getFormData($name) : (isset($attributs['value']) ? $attributs['value'] : ''); ?>"
                                    placeholder="<?php echo isset($attributs['placeholder']) ? $attributs['placeholder'] : ''; ?>"
                                    id="<?php echo "input-" . $name; ?>"
                                <?php echo(isset($attributs['required']) ? 'required="required"' : ''); ?>
                                <?php echo(isset($attributs['disabled']) ? 'disabled="disabled"' : ''); ?>
                            >
                        <?php endif; ?>

                        <?php if ($attributs['type'] == 'file'): ?>
                            <label class="<?php echo(isset($attributs['required']) ? 'required' : ''); ?>"
                                   for="<?php echo "input-" . $name; ?>"><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?></label>
                            <input type="<?php echo $attributs['type']; ?>"
                                   name="<?php echo $name; ?>"
                                   accept="<?php echo isset($attributs['accept']) ? $attributs['accept'] : ''; ?>"
                                   id="<?php echo "input-" . $name; ?>"
                                <?php echo(isset($attributs['required']) ? 'required="required"' : ''); ?>
                                <?php echo(isset($attributs['disabled']) ? 'disabled="disabled"' : ''); ?>
                            >
                        <?php endif; ?>

                        <?php if ($attributs['type'] == 'checkbox'): ?>
                            <label class="<?php echo(isset($attributs['required']) ? 'required' : ''); ?>"
                                   for="<?php echo "input-" . $name; ?>"><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?></label>
                            <input type="<?php echo $attributs['type']; ?>"
                                   name="<?php echo $name; ?>"
                                   value="1"
                                   id="<?php echo "input-" . $name; ?>"
                                <?php echo (($attributs['value'] && $attributs['value'] == true) || Session::getFormData($name)) ? 'checked="checked"' : ''; ?>
                            >
                        <?php endif; ?>

                        <?php if ($attributs['type'] == 'select'): ?>
                            <label class="<?php echo(isset($attributs['required']) ? 'required' : ''); ?>"
                                   for="<?php echo "input-" . $name; ?>"><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?></label>
                            <select name="<?php echo $name; ?>" id="<?php echo "input-" . $name; ?>">
                                <?php foreach ($attributs['options'] as $selectLabel => $selectValue): ?>
                                    <option
                                            value="<?php echo $selectValue; ?>"
                                        <?php $value = !empty(Session::getFormData($name)) ?
                                            Session::getFormData($name) : (isset($attributs['value']) ?
                                                $attributs['value'] : ''); ?>
                                        <?php echo (!empty($value) && $value == $selectValue) ?
                                            'selected="selected"' : ''; ?>
                                    >
                                        <?php echo $selectLabel; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>

                        <?php if ($attributs['type'] == 'hidden'): ?>
                            <input type="<?php echo $attributs['type']; ?>"
                                   name="<?php echo $name; ?>"
                                   value="<?php echo !empty(Session::getFormData($name)) ?
                                       Session::getFormData($name) : (isset($attributs['value']) ?
                                           $attributs['value'] : ''); ?>"
                            >
                        <?php endif; ?>

                        <?php if ($attributs['type'] == 'textarea'): ?>
                            <label class="vertical-align <?php echo(isset($attributs['required']) ? 'required' : ''); ?>"
                                   for="<?php echo "input-" . $name; ?>"><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?></label>
                            <textarea
                                    name="<?php echo $name; ?>"
                                    placeholder="<?php echo isset($attributs['placeholder']) ? $attributs['placeholder'] : ''; ?>"
                                    id="<?php echo "input-" . $name; ?>"
                                    cols="50"
                                    rows="5"
                                <?php echo(isset($attributs['disabled']) ? 'disabled="disabled"' : ''); ?>
                            ><?php echo(!empty(Session::getFormData($name)) ?
                                    Session::getFormData($name) : (isset($attributs['value']) ?
                                        $attributs['value'] : '')); ?></textarea>
                        <?php endif; ?>

                        <?php if ($attributs['type'] == 'radio'): ?>
                            <?php foreach ($attributs['options'] as $radioLabel => $radioValue): ?>
                                <label><?php echo $radioLabel; ?></label>
                                <input type="<?php echo $attributs['type']; ?>"
                                       name="<?php echo $name; ?>"
                                       value="<?php echo $radioValue; ?>"
                                    <?php $value = !empty(Session::getFormData($name) ?
                                        Session::getFormData($name) : (isset($attributs['value']) ?
                                            $attributs['value'] : '')); ?>
                                    <?php echo (!empty($value) && $value == $radioValue) ?
                                        'checked="checked"' : ''; ?>
                                >
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if ($attributs['type'] == 'date'): ?>
                            <label class="<?php echo(isset($attributs['required']) ? 'required' : ''); ?>"
                                   for="<?php echo "input-" . $name; ?>"><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?></label>
                            <input type="<?php echo $attributs['type']; ?>"
                                   name="<?php echo $name; ?>"
                                   value="<?php echo(!empty(Session::getFormData($name)) ?
                                       Session::getFormData($name) : (isset($attributs['value']) ?
                                           $attributs['value'] : '')); ?>"
                                   placeholder="JJ/MM/YYYY"
                                   id="<?php echo "input-" . $name; ?>"
                            >
                        <?php endif; ?>
                    </div>

                    <?php if ($attributs['type'] == 'widget'): ?>
                        <?php $attributs['data']['name'] = $name; ?>
                        <?php $this->includeWidget($attributs['id'], isset($attributs['data']) ? $attributs['data'] : []); ?>

                        <?php if(!empty($attributs['script'])): ?>
                            <?php if(is_array($attributs['script'])): ?>
                                <?php foreach ($attributs['script'] as $script): ?>
                                    <script><?php include 'app/assets/js/modals/widgets/'.$script; ?></script>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <script><?php include 'app/assets/js/modals/widgets/'.$attributs['script']; ?></script>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php endforeach; ?>
            <?php endforeach; ?>
            <?php if (isset($config[Editable::FORM_STRUCT]['hide_header'])): ?>
                <button class="button primary">
                    Suivant
                </button>
            <?php endif; ?>
        </form>
    <?php endif; ?>
</div>

<script src="<?php echo Helpers::getAsset('js/modals/form.js'); ?>"></script>
<script>
    var mediaPreview = '<?php echo Helpers::getAdminRoute('media/preview'); ?>';
</script>
<?php Session::resetFormData(); ?>
