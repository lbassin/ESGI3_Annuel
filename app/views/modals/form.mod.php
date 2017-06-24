<div id="form">
    <?php if (isset($config[Editable::FORM_STRUCT])): ?>
        <?php if (!isset($config[Editable::FORM_GROUPS])): ?>
            <?php $config[Editable::FORM_GROUPS] = []; ?>
        <?php endif; ?>

        <form method="<?php echo $config[Editable::FORM_STRUCT]['method']; ?>"
              action="<?php echo $config[Editable::FORM_STRUCT]['action']; ?>"
              class="<?php echo $config[Editable::FORM_STRUCT]['class']; ?>"
            <?php echo(isset($config[Editable::FORM_STRUCT]['file']) ? 'enctype="multipart/form-data"' : 'text/plain'); ?>
        >

            <div id="menu">
                <div id="action">
                    <a href="<?php echo Helpers::getAdminRoute('user'); ?>" class="button secondary">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                    </a>
                    <a href="#" class="button secondary">
                        Delete
                    </a>
                    <a href="#" class="button secondary">
                        Reset
                    </a>
                    <a href="#" class="button secondary">
                        Save and Continue Edit
                    </a>
                    <input type="submit" class="button primary" value="Save">
                </div>
            </div>

            <input type="hidden" name="token" value="<?php echo Session::getToken(); ?>">

            <?php foreach ($config[Editable::FORM_GROUPS] as $group): ?>
                <h2><?php echo $group['label']; ?></h2>

                <?php foreach ($group[Editable::GROUP_FIELDS] as $name => $attributs): ?>

                    <div class="field-line">
                        <?php if ($attributs['type'] == 'email' || $attributs['type'] == 'text' || $attributs['type'] == 'password'): ?>
                            <label for="<?php echo "input-" . $name; ?>"><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?></label>
                            <input
                                    type="<?php echo $attributs['type']; ?>"
                                    name="<?php echo $name; ?>"
                                    value="<?php echo isset($attributs['value']) ? $attributs['value'] : ''; ?>"
                                    placeholder="<?php echo isset($attributs['placeholder']) ? $attributs['placeholder'] : ''; ?>"
                                    id="<?php echo "input-" . $name; ?>"
                                <?php echo(isset($attributs['required']) ? 'required="required"' : ''); ?>
                                <?php echo(isset($attributs['disabled']) ? 'disabled="disabled"' : ''); ?>
                            >
                        <?php endif; ?>

                        <?php if ($attributs['type'] == 'file'): ?>
                            <label for="<?php echo "input-" . $name; ?>"><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?></label>
                            <input type="<?php echo $attributs['type']; ?>"
                                   name="<?php echo $name; ?>"
                                   accept="<?php echo isset($attributs['accept']) ? $attributs['accept'] : ''; ?>"
                                   id="<?php echo "input-" . $name; ?>"
                                <?php echo(isset($attributs['required']) ? 'required="required"' : ''); ?>
                                <?php echo(isset($attributs['disabled']) ? 'disabled="disabled"' : ''); ?>
                            >
                        <?php endif; ?>

                        <?php if ($attributs['type'] == 'checkbox'): ?>
                            <label for="<?php echo "input-" . $name; ?>"><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?></label>
                            <input type="<?php echo $attributs['type']; ?>"
                                   name="<?php echo $name; ?>"
                                   value="1"
                                   id="<?php echo "input-" . $name; ?>"
                                <?php echo ($attributs['value'] == true) ? 'checked="checked"' : ''; ?>
                            >
                        <?php endif; ?>

                        <?php if ($attributs['type'] == 'select'): ?>
                            <label for="<?php echo "input-" . $name; ?>"><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?></label>
                            <select name="<?php echo $name; ?>" id="<?php echo "input-" . $name; ?>">
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
                        <?php endif; ?>

                        <?php if ($attributs['type'] == 'hidden'): ?>
                            <input type="<?php echo $attributs['type']; ?>"
                                   name="<?php echo $name; ?>"
                                   value="<?php echo $attributs['value']; ?>"
                            >
                        <?php endif; ?>

                        <?php if ($attributs['type'] == 'textarea'): ?>
                            <label for="<?php echo "input-" . $name; ?>"><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?></label>
                            <textarea
                                    name="<?php echo $name; ?>"
                                    placeholder="<?php echo isset($attributs['placeholder']) ? $attributs['placeholder'] : ''; ?>"
                                    id="<?php echo "input-" . $name; ?>"
                                    cols="50"
                                    rows="5"
                                <?php echo(isset($attributs['required']) ? 'required="required"' : ''); ?>
                                <?php echo(isset($attributs['disabled']) ? 'disabled="disabled"' : ''); ?>
                            ><?php echo(isset($attributs['value']) ? $attributs['value'] : ''); ?></textarea>
                        <?php endif; ?>

                        <?php if ($attributs['type'] == 'radio'): ?>
                            <?php foreach ($attributs['options'] as $radioLabel => $radioValue): ?>
                                <label><?php echo $radioLabel; ?></label>
                                <input type="<?php echo $attributs['type']; ?>"
                                       name="<?php echo $name; ?>"
                                       value="<?php echo $radioValue; ?>"
                                    <?php echo (isset($attributs['value']) && $attributs['value'] == $radioValue) ?
                                        'checked="checked"' : ''; ?>
                                >
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if ($attributs['type'] == 'date'): ?>
                            <label for="<?php echo "input-" . $name; ?>"><?php echo isset($attributs['label']) ? $attributs['label'] : ''; ?></label>
                            <input type="<?php echo $attributs['type']; ?>"
                                   name="<?php echo $name; ?>"
                                   value="<?php echo(isset($attributs['value']) ? $attributs['value'] : ''); ?>"
                                   placeholder="JJ/MM/YYYY"
                                   id="<?php echo "input-" . $name; ?>"
                            >
                        <?php endif; ?>
                    </div>

                    <?php if($attributs['type'] == 'widget'): ?>
                        <?php $this->includeWidget($attributs['id']); ?>
                    <?php endif; ?>

                <?php endforeach; ?>
            <?php endforeach; ?>

            <!--            <input type="submit"-->
            <!--                   class="-->
            <?php //echo isset($config[Editable::FORM_STRUCT]['submit-class']) ? $config[Editable::FORM_STRUCT]['submit-class'] : ''; ?><!--"-->
            <!--                   value="--><?php //echo $config[Editable::FORM_STRUCT]['submit']; ?><!--">-->
        </form>
    <?php endif; ?>
</div>