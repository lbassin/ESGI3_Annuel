<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="...">
    <title>Account Setup</title>

    <script src="app/assets/js/Ajax.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="app/assets/css/setup.css">
</head>
<body>
<div class="setup">
    <?php require 'app/assets/logo.html'; ?>

    <div class="header">
        <div class="breadcrumbs"></div>
        <div class="status-progress">
            <ul class="clearfix">
                <?php $step = isset($step) ? $step : 0; ?>
                <?php for ($i = 1; $i < 6; $i++): ?>
                    <li>
                        <span class="<?php echo $step == $i ? 'current' : ''; ?>"><?php echo $i; ?></span>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
    <div class="content">
        <?php include $this->view; ?>
    </div>

</div>
</body>
</html>