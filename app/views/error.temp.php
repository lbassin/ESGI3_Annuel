<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="...">
    <title>Error <?php echo(isset($errorCode) ? $errorCode : ''); ?></title>
</head>
<body style="text-align: center;">
<?php include $this->view; ?>
</body>
</html>