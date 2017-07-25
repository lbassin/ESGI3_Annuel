<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo Helpers::getThemeAsset('css/theme.css'); ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <title>Home</title>
</head>
<body>
<div class="container">
    <div class="nav-container">
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
                             x="0px" y="0px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve"
                             width="20px" height="20px">
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
    </div>
    <div class="top-container">
        <div class="top-content-container">
            <div class="top-title">
                <h1>Titre</h1>
            </div>
            <div class="top-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam asperiore blanditiis corporis
                    debitis delectus dolore in, ipsam ipsum iure libero minima nesciunt nostrum, odit, omnis quas
                    repudiandae sed tempora voluptatem?
                </p>
            </div>
        </div>
    </div>
    <div class="container-cases">
        <div class="cases">
            <div class="case">
                <div class="case-avatar">
                    <img src="http://lorempicsum.com/nemo/255/200/5" alt="">
                </div>
                <div class="case-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet aperiam dolorem dolorum eius est
                        in maiores molestiae neque nostrum officia perferendis porro praesentium provident quas qui
                        recusandae, reiciendis totam voluptates.</p>
                    <a href="#">Lien ...</a>
                </div>
            </div>
            <div class="case">
                <div class="case-avatar">
                    <img src="http://lorempicsum.com/nemo/255/200/5" alt="">
                </div>
                <div class="case-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet aperiam dolorem dolorum eius est
                        in maiores molestiae neque nostrum officia perferendis porro praesentium provident quas qui
                        recusandae, reiciendis totam voluptates.</p>
                    <a href="#">Lien ...</a>
                </div>
            </div>
            <div class="case">
                <div class="case-avatar">
                    <img src="http://lorempicsum.com/nemo/255/200/5" alt="">
                </div>
                <div class="case-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet aperiam dolorem dolorum eius est
                        in maiores molestiae neque nostrum officia perferendis porro praesentium provident quas qui
                        recusandae, reiciendis totam voluptates.</p>
                    <a href="#">Lien ...</a>
                </div>
            </div>
        </div>
    </div>
    <div class="middle-container">
        <div class="middle-title">
            <h2>Titre</h2>
        </div>
        <div class="middle-content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam asperiore
                blanditiis corporis debitis delectus dolore in, ipsam ipsum iure libero minima nesciunt nostrum, odit,
                omnis quas repudiandae sed tempora voluptatem?
            </p>
        </div>
        <div class="middle-image">
            <img src="https://statamic.com/img/screens/cp-alt.png" alt="">
        </div>
    </div>
    <div class="bottom-container">
        <div class="bottom-image">
            <img src="https://statamic.com/img/screens/pages.png" alt="">
        </div>
        <div class="bottom-content">
            <h2>Titre</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam asperiore
                blanditiis corporis debitis delectus dolore in, ipsam ipsum iure libero minima nesciunt nostrum, odit,
                omnis quas repudiandae sed tempora voluptatem?
            </p>
        </div>
    </div>
</div>
<script src="<?php echo Helpers::getThemeAsset('js/dropdown.js'); ?>"></script>
</body>
</html>