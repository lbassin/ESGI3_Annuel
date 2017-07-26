<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo(isset($title) ? $title : ''); ?></title>
    <meta name="description" content="<?php echo(isset($description) ? $description : ''); ?>">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,900|Montserrat" rel="stylesheet">
    <link href="<?php echo Helpers::getThemeAsset('css/app.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo Helpers::getThemeAsset('css/article_view.css'); ?>">
    <link rel="stylesheet" href="<?php echo Helpers::getThemeAsset('css/article.css'); ?>">
    <link rel="stylesheet" href="<?php echo Helpers::getThemeAsset('css/article_search.css'); ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo Helpers::getThemeAsset('css/theme.css'); ?>">
    <link rel="stylesheet" type="text/css"
          href="<?php echo Helpers::getAsset('font-awesome/css/font-awesome.min.css'); ?>">

    <link href="//cdn.quilljs.com/1.2.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.2.6/quill.bubble.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/dracula.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script src="//cdn.quilljs.com/1.2.6/quill.js"></script>
</head>
<body>

<nav class="nav-container">
    <div class="nav-content">
        <ul>
            <li class="nav-logo"><a href="#"><img src="<?php echo Helpers::getAsset('mail-logo.png'); ?>" alt=""></a>
            </li>
            <?php $i = 0; ?>
            <?php foreach ($menu as $link): ?>
                <?php $i++; ?>
                <?php if (count($link->subMenu) == 0): ?>
                    <li class="<?php echo $i == count($menu) ? 'nav-end' : ''; ?>"><a
                                href="<?php echo Helpers::getFrontRoute($link->url()); ?>"><?php echo $link->label(); ?></a>
                    </li>
                <?php else: ?>
                    <div class="nav-dropdown">
                        <li class="<?php echo $i == count($menu) ? 'nav-end' : ''; ?>">
                            <a href="<?php echo Helpers::getFrontRoute($link->url()); ?>"><?php echo $link->label(); ?>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                        </li>
                        <div id="myDropdown" class="nav-dropdown-content">
                            <?php foreach ($link->subMenu as $submenu): ?>
                                <a href="<?php echo Helpers::getFrontRoute($submenu['url']); ?>"><?php echo $submenu['label']; ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>

<div class="container">
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

    <?php if (count(Session::getSuccess()) > 0): ?>
        <div class="flash-messages success">
            <ul>
                <?php foreach (Session::getSuccess() as $success): ?>
                    <li><?php echo $success; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php Session::resetSuccess(); ?>
    <?php endif; ?>
    <?php include $this->view; ?>
</div>

<script src="<?php echo Helpers::getAsset('js/wysiwyg.js'); ?>"></script>
<script src="<?php echo Helpers::getThemeAsset('js/dropdown-menu.js'); ?>"></script>

</body>
</html>
