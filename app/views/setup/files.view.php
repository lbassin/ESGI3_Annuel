<?php if (!isset($error)): ?>
    Config files successfully created
    <br>

    <?php $backoffice = 'http://' . trim($_SERVER['SERVER_NAME'] . '/' . trim(BASE_PATH, '/'), '/') . '/' . ADMIN_PATH . '/login'; ?>
    Back Office : <a href="<?php echo $backoffice; ?>"><?php echo $backoffice; ?></a>
<?php else: ?>
    An error occured : the system is not able to create configuration files. <br>
    Please check this and retry. <br>
    <a href="index.php?step=4">
        <button>Retry</button>
    </a>
<?php endif; ?>
