<div class="container-cases">
    <div class="cases">
        <div class="case">
            <div class="case-content">
                <?php if (isset($data['editor0'])): ?>
                    <p data-wysiwyg='<?php echo $data['editor0']; ?>'></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="case">
            <div class="case-content">
                <?php if (isset($data['editor1'])): ?>
                    <p data-wysiwyg='<?php echo $data['editor1']; ?>'></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="case">
            <div class="case-content">
                <?php if (isset($data['editor2'])): ?>
                    <p data-wysiwyg='<?php echo $data['editor2']; ?>'></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>