<?php if (count(Session::getErrors()) > 0): ?>
    <div class="flash-messages errors">
        <ul>
            <?php foreach (Session::getErrors() as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php Session::resetErrors(); ?>
<?php endif; ?>
<?php
/** @var $config Config */
if (isset($config)) {
    $this->includeModal('form', $config->getSetupForm());
}