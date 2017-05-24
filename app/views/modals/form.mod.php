<?php if (isset($config[Editable::FORM_STRUCT])): ?>
    <?php if (!isset($config[Editable::FORM_GROUPS])): ?>
        <?php $config[Editable::FORM_GROUPS] = []; ?>
    <?php endif; ?>

    <form method="<?php echo $config[Editable::FORM_STRUCT]['method']; ?>"
          action="<?php echo $config[Editable::FORM_STRUCT]['action']; ?>"
          class="<?php echo (isset($config[Editable::FORM_STRUCT]['class']) ? $config[Editable::FORM_STRUCT]['class'] : '');?>"
        <?php echo(isset($config[Editable::FORM_STRUCT]['file']) ? 'enctype="multipart/form-data"' : 'text/plain'); ?>
    >
        <input type="hidden" name="token" value="<?php echo Session::getToken(); ?>">

        <?php foreach ($config[Editable::FORM_GROUPS] as $group): ?>
            <h2><?php echo $group['label']; ?></h2>

            <?php foreach ($group[Editable::GROUP_FIELDS] as $name => $attributs): ?>

                <p class="<?php echo isset($attributs['class']) ? $attributs['class'] : 'two-col'; ?>">
                    <?php if ($attributs['type'] == 'email' || $attributs['type'] == 'text' || $attributs['type'] == 'password'): ?>
                        <label><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?><br>
                            <input
                                    type="<?php echo $attributs['type']; ?>"
                                    name="<?php echo $name; ?>"
                                    value="<?php echo isset($attributs['value']) ? $attributs['value'] : ''; ?>"
                                    placeholder="<?php echo isset($attributs['placeholder']) ? $attributs['placeholder'] : ''; ?>"
                                <?php echo(isset($attributs['required']) ? 'required="required"' : ''); ?>
                                <?php echo(isset($attributs['disabled']) ? 'disabled="disabled"' : ''); ?>
                            >
                        </label>
                    <?php endif; ?>

                    <?php if ($attributs['type'] == 'file'): ?>
                        <label><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?>
                            <input type="<?php echo $attributs['type']; ?>"
                                   name="<?php echo $name; ?>"
                                   accept="<?php echo isset($attributs['accept']) ? $attributs['accept'] : ''; ?>"
                                <?php echo(isset($attributs['required']) ? 'required="required"' : ''); ?>
                                <?php echo(isset($attributs['disabled']) ? 'disabled="disabled"' : ''); ?>
                            >
                        </label>
                    <?php endif; ?>

                    <?php if ($attributs['type'] == 'checkbox'): ?>
                        <label><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?>
                            <input type="<?php echo $attributs['type']; ?>"
                                   name="<?php echo $name; ?>"
                                   value="1"
                                <?php echo ($attributs['value'] == true) ? 'checked="checked"' : ''; ?>
                            >
                        </label>
                    <?php endif; ?>

                    <?php if ($attributs['type'] == 'select'): ?>
                        <label><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?>
                            <select name="<?php echo $name; ?>">
                                <?php foreach ($attributs['options'] as $selectLabel => $selectValue): ?>
                                    <option
                                            value="<?php echo $selectValue; ?>"
                                        <?php echo (isset($attributs['value']) && $attributs['value'] == $selectValue) ?
                                            'selected="selected"' : ''; ?>
                                    >
                                        <?php echo $selectLabel; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    <?php endif; ?>

                    <?php if ($attributs['type'] == 'hidden'): ?>
                        <input type="<?php echo $attributs['type']; ?>"
                               name="<?php echo $name; ?>"
                               value="<?php echo $attributs['value']; ?>"
                        >
                    <?php endif; ?>

                    <?php if ($attributs['type'] == 'textarea'): ?>
                        <label><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?>
                            <textarea
                                    name="<?php echo $name; ?>"
                                    placeholder="<?php echo isset($attributs['placeholder']) ? $attributs['placeholder'] : ''; ?>"
                                <?php echo(isset($attributs['required']) ? 'required="required"' : ''); ?>
                                <?php echo(isset($attributs['disabled']) ? 'disabled="disabled"' : ''); ?>
                            ><?php echo(isset($attributs['value']) ? $attributs['value'] : ''); ?></textarea>
                        </label>
                    <?php endif; ?>

                    <?php if ($attributs['type'] == 'radio'): ?>
                        <?php foreach ($attributs['options'] as $radioLabel => $radioValue): ?>
                            <label><?php echo $radioLabel; ?>
                                <input type="<?php echo $attributs['type']; ?>"
                                       name="<?php echo $name; ?>"
                                       value="<?php echo $radioValue; ?>"
                                    <?php echo (isset($attributs['value']) && $attributs['value'] == $radioValue) ?
                                        'checked="checked"' : ''; ?>
                                >
                            </label>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if ($attributs['type'] == 'date'): ?>
                        <label><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?>
                            <input type="<?php echo $attributs['type']; ?>"
                                   name="<?php echo $name; ?>"
                                   value="<?php echo(isset($attributs['value']) ? $attributs['value'] : ''); ?>"
                                   placeholder="JJ/MM/YYYY"
                            >
                        </label>
                    <?php endif; ?>
                </p>

            <?php endforeach; ?>
        <?php endforeach; ?>

        <br>
        <input type="submit"
               class="<?php echo isset($config[Editable::FORM_STRUCT]['submit-class']) ? $config[Editable::FORM_STRUCT]['submit-class'] : ''; ?>"
               value="<?php echo $config[Editable::FORM_STRUCT]['submit']; ?>">
    </form>
<?php endif; ?>
