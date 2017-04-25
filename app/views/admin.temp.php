<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Backoffice</title>
        <link rel="stylesheet" type="text/css" href="<?php echo Helpers::getAsset('css/admin.css'); ?>">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <nav class="slide-nav">
                <a class="nav-link">Dashboard</a>
                <a class="nav-link">Updates</a>
                <a class="nav-link">Pages</a>
                <a class="nav-link">Articles</a>
                <a class="nav-link">Catégories</a>
                <a class="nav-link">Comments</a>
                <a class="nav-link">Médias</a>
                <a class="nav-link">Styles</a>
                <a class="nav-link" href="<?php echo Helpers::getAdminRoute('user'); ?>">Users</a>
                <a class="nav-link">Plugins</a>
            </nav>

            <div class="settings-nav">
                <div class="settings-title">
                    Settings
                </div>

                <a class="nav-link">Mon compte</a>
                <a class="nav-link">Accès front</a>

                <a href="#" class="logout">Logout</a>
            </div>

            <header class="header">
                <div id="nav-icon" class="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="title-header">Qwarkz</div>

                <div id="nav-icon-config" class="nav-settings-toogle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

            </header>
        </div>

        <div id="back-office" class="container">
            <?php include $this->view; ?>
        </div>

        <script type="text/javascript" src="<?php echo Helpers::getAsset('js/admin.js'); ?>"></script>
    </body>
</html>