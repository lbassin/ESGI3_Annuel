<form method="<?php echo $config['struct']['method']; ?>"
      action="<?php echo $config['struct']['action']; ?>"
      class="<?php echo $config['struct']['class']; ?>"
      enctype="<?php echo(isset($config['struct']['file']) ? 'multipart/form-data' : 'text/plain'); ?>"
>


    <?php foreach ($config['data'] as $name => $attributs): ?>
        <?php echo $name; ?>
        <?php if ($attributs['type'] == 'email'
            || $attributs['type'] == 'text'
            || $attributs['type'] == 'password'
        ): ?>
            <label>
                <input type="<?php echo $attributs['type']; ?>"
                       name="<?php echo $name; ?>"
                       placeholder="<?php echo $attributs['placeholder']; ?>"
                    <?php echo(isset($attributs['required']) ? 'required="required"' : ''); ?>
                    <?php echo(isset($attributs['disabled']) ? 'disabled="disabled"' : ''); ?>
                >
            </label>
        <?php endif; ?>

        <?php if ($attributs['type'] == 'file'): ?>
            <input type="<?php echo $attributs['type']; ?>"
                   name="<?php echo $name; ?>"
                   accept="<?php echo $attributs['accept']; ?>"
                <?php echo(isset($attributs['required']) ? 'required="required"' : ''); ?>
                <?php echo(isset($attributs['disabled']) ? 'disabled="disabled"' : ''); ?>
            >
        <?php endif; ?>

        <?php if ($attributs['type'] == 'hidden'): ?>
            <input type="<?php echo $attributs['type']; ?>"
                   name="<?php echo $name; ?>"
                   value="<?php echo $attributs['value']; ?>"
            >
        <?php endif; ?>

        <?php if ($attributs['type'] == 'date'): ?>
            <input type="<?php echo $attributs['type']; ?>"
                   name="<?php echo $name; ?>"
                   placeholder="JJ/MM/YYYY"
            >
        <?php endif; ?>

        <?php if ($attributs['type'] == 'textarea'): ?>
            <textarea
                name="<?php echo $name; ?>"
                placeholder="<?php echo $attributs['placeholder']; ?>"
                <?php echo(isset($attributs['required']) ? 'required="required"' : ''); ?>
                <?php echo(isset($attributs['disabled']) ? 'disabled="disabled"' : ''); ?>
            ></textarea>
        <?php endif; ?>

        <?php if ($attributs['type'] == 'checkbox'): ?>
            <label><?php echo $attributs['label']; ?>
                <input type="<?php echo $attributs['type']; ?>"
                       name="<?php echo $attributs['name']; ?>"
                >
            </label>
        <?php endif; ?>

        <?php if ($attributs['type'] == 'radio'): ?>
            <?php foreach ($attributs['value'] as $radioLabel => $radioValue): ?>
                <label><?php echo $radioLabel; ?>
                    <input type="<?php echo $attributs['type']; ?>"
                           name="<?php echo $name; ?>"
                           value="<?php echo $radioValue; ?>"
                    >
                </label>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($attributs['type'] == 'select'): ?>
            <select name="<?php echo $name; ?>">
                <?php foreach ($attributs['value'] as $selectLabel => $selectValue): ?>
                    <option value="<?php echo $selectValue; ?>">
                        <?php echo $selectLabel; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>

        <hr>
        <br>
    <?php endforeach; ?>

    <input type="submit" value="<?php echo $config['struct']['submit']; ?>">
</form>