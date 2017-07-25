<?php if (isset($categories)): ?>
    templates Liste catégorie
<?php elseif (isset($category)): ?>
    Templates Liste articles
<?php else: ?>
    <?php Helpers::error404(); ?>
<?php endif; ?>
