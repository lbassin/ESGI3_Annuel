<?php /** @var array $data */ ?>

<div class="middle-container">
    <div class="middle-title">
        <h2><?php echo isset($data['title']) ? $data['title'] : ''; ?></h2>
    </div>
    <div class="middle-content">
        <?php if (isset($data['editor0'])): ?>
            <p data-wysiwyg='<?php echo $data['editor0']; ?>'></p>
        <?php endif; ?>
    </div>
    <div class="middle-image">
        <?php if (isset($data['path_image'])): ?>
            <img src="<?php echo $data['path_image']; ?>" alt="">
        <?php endif; ?>
    </div>
</div>