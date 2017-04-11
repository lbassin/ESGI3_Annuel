<form method="<?php echo $config['struct']['method']; ?>"
      action="<?php echo $config['struct']['action']; ?>"
      class="<?php echo $config['struct']['class']; ?>"
      enctype="<?php echo(isset($config['struct']['file']) ? 'multipart/form-data' : 'text/plain'); ?>"
>


    <?php foreach ($config['data'] as $name => $attributs): ?>

        <?php if ($attributs['type'] == 'email'
            || $attributs['type'] == 'text'
            || $attributs['type'] == 'password'
        ): ?>
            <input type="<?php echo $attributs['type']; ?>"
                   name="<?php echo $name; ?>"
                   placeholder="<?php echo $attributs['placeholder']; ?>"
            <?php echo(isset($attributs['required']) ? 'required="required"' : ''); ?>
            <?php echo(isset($attributs['disabled']) ? 'disabled="disabled"' : ''); ?>
            >
            <br>
        <?php endif; ?>

        <?php if ($attributs['type'] == 'file'): ?>
            <input type="<?php echo $attributs['type']; ?>"
                   name="<?php echo $name; ?>"
                   accept="<?php echo $attributs['accept']; ?>"
                <?php echo(isset($attributs['required']) ? 'required="required"' : ''); ?>
                <?php echo(isset($attributs['disabled']) ? 'disabled="disabled"' : ''); ?>
            >
            <br>
        <?php endif; ?>

        <?php if ($attributs['type'] == 'hidden'): ?>
            <input  type="<?php echo $attributs['type']; ?>"
                    name="<?php echo $name; ?>"
                    value="<?php echo $attributs['value']; ?>"
            >
        <?php endif;?>
    <?php endforeach; ?>

    <input type="submit" value="<?php echo $config['struct']['submit']; ?>">
</form>


<!--
    checkbox
    date
    image
    number
    radio
-->