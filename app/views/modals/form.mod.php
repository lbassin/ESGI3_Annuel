<h1>Nouvel utilisateur</h1>
<small><a href="<?php echo Helpers::getAdminRoute('user'); ?>">Back</a></small>

<form method="<?php echo $config['struct']['method']; ?>"
      action="<?php echo $config['struct']['action']; ?>"
      class="<?php echo $config['struct']['class']; ?>"
      enctype="<?php echo(isset($config['struct']['file']) ? 'multipart/form-data' : 'text/plain'); ?>"
>

    <?php foreach ($config['groups'] as $group): ?>
        <h2><?php echo $group['label']; ?></h2>

        <?php foreach ($group['fields'] as $name => $attributs): ?>

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
                               name="<?php echo $attributs['name']; ?>"
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
    <input type="submit" value="<?php echo $config['struct']['submit']; ?>">
</form>