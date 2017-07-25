<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo(isset($title) ? $title : ''); ?></title>
    <meta name="description" content="<?php echo(isset($description) ? $description : ''); ?>">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,900|Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo Helpers::getThemeAsset('css/theme.css'); ?>">

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
    <nav class="nav-content">
        <ul>
            <li class="nav-logo"><a href="#">LOGO</a></li>
            <li><a href="#">Buy now</a></li>
            <li><a href="#">Try</a></li>
            <li><a href="#">Features</a></li>
            <li><a href="#">Docs</a></li>
            <li class="nav-end"><a href="#">Support</a></li>
            <div class="nav-dropdown">
                <button onclick="dropdown()" class="nav-dropdown-button">Dropdown
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve" width="20px" height="20px">
                            <path d="M13.418,7.859c0.271-0.268,0.709-0.268,0.978,0c0.27,0.268,0.272,0.701,0,0.969l-3.908,3.83c-0.27,0.268-0.707,0.268-0.979,0l-3.908-3.83c
                            -0.27-0.267-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.978,0L10,11L13.418,7.859z"></path>
                        </svg>
                </button>
                <div id="myDropdown" class="nav-dropdown-content">
                    <a href="#">Lien 1</a>
                    <a href="#">Lien 2</a>
                    <a href="#">Lien 3</a>
                </div>
            </div>
        </ul>
    </nav>
</nav>

<div class="container">
    <?php include $this->view; ?>
</div>

    <script src="<?php echo Helpers::getAsset('js/wysiwyg.js'); ?>"></script>
</body>
</html>
