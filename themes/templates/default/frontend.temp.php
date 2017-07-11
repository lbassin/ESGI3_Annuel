<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo(isset($title) ? $title : ''); ?></title>
    <meta name="description" content="<?php echo(isset($description) ? $description : ''); ?>">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,900|Montserrat" rel="stylesheet">
    <link href="<?php echo Helpers::getThemeAsset('css/app.css'); ?>" rel="stylesheet">

    <link href="//cdn.quilljs.com/1.2.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.2.6/quill.bubble.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/dracula.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script src="//cdn.quilljs.com/1.2.6/quill.js"></script>
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

    <script src="<?php echo Helpers::getAsset('js/wysiwyg.js'); ?>"></script>
</body>
</html>
