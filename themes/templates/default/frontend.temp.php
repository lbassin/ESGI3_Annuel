<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo(isset($title) ? $title : ''); ?></title>
    <meta name="description" content="<?php echo(isset($description) ? $description : ''); ?>">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,900|Montserrat" rel="stylesheet">
    <link href="<?php echo Helpers::getThemeAsset('css/app.css'); ?>" rel="stylesheet">
</head>
<body>

<nav>
    <ul>
        <li class="logo"><img src="http://lorempixel.com/32/32" alt="logo">
        <li>Home
        <li>Try
        <li>Features
        <li>Docs
        <li>Support
    </ul>
</nav>

<div class="container">
    <?php foreach ($components as $component): ?>
        <div class="row">
            <?php echo $component; ?>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
