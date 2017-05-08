<?php if (isset($_SESSION['errors'])): ?>
    <div style="color: red;">
        <?php Helpers::debug($_SESSION['errors']); ?>
    </div>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<?php
/** @var $config Config */
if (isset($config)) {
    $this->includeModal('form', $config->getSetupForm());
}