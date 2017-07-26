<div class="bottom-container">
    <div class="bottom-image">
        <img src="<?php echo isset($data['path_image']) ? $data['path_image'] : ''; ?>" alt="">
    </div>
    <div class="bottom-content">
        <h2><?php echo isset($data['title']) ? $data['title'] : ''; ?></h2>
        <?php if (isset($data['editor0'])): ?>
            <p data-wysiwyg='<?php echo $data['editor0']; ?>'></p>
        <?php endif; ?>
    </div>
</div>