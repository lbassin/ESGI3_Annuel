<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="...">
    <title>Error <?php echo(isset($errorCode) ? $errorCode : ''); ?></title>

    <link rel="stylesheet" href="<?php echo Helpers::getAsset('css/error.css'); ?>">
</head>
<body>
<?php include $this->view; ?>
</body>
</html>