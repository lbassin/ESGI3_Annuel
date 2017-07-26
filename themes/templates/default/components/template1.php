<?php /** @var array $data */ ?>

<div class="top-container" style="background-image: url('<?php echo isset($data['path_background']) ? $data['path_background'] : ''; ?>')">
    <div class="top-content-container">
        <div class="top-title">
            <h1><?php echo isset($data['title']) ? $data['title'] : ''; ?></h1>
        </div>
        <?php if (isset($data['editor0'])): ?>
            <div class="top-content">
                <p data-wysiwyg='<?php echo $data['editor0']; ?>'></p>
            </div>
        <?php endif; ?>
    </div>
</div>