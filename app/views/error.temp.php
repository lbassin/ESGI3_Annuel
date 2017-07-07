<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Error <?php echo(isset($errorCode) ? $errorCode : ''); ?></title>
        <link rel="stylesheet" href="<?php echo Helpers::getAsset('css/error.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo Helpers::getAsset('css/login.css'); ?>">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    </head>
    <body>

        <div class="container">
            <?php include $this->view; ?>
        </div>

    </body>
</html>
