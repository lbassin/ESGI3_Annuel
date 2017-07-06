<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Backoffice</title>
        <link rel="stylesheet" type="text/css" href="<?php echo Helpers::getAsset('css/login.css'); ?>">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <script src="<?php echo Helpers::getAsset('js/Ajax.js'); ?>"></script>
    </head>
    <body>

        <div class="container" style="height: 100vh;display: flex;align-items: center;justify-content: center;">
            <div id="popup-message">

            </div>

            <span class="container-login">
                <?php include 'app/assets/logo.html'; ?>
                <form method="post" id="container-login-form" class="container-login-form">
                    <div class="field-container">
                        <input type="text" name="email" placeholder="Identifiant">
                    </div>
                    <br>
                    <div class="field-container">
                        <input type="password" name="password" placeholder="Mot de passe">
                    </div>

                    <input type="submit" class="login-submit" id="login" value="Se connecter">
                    <a id="forget-password-button" class="link-password-forget button-login-page">
                        <span class="hover-link-center">Mot de passe oublié</span>
                    </a>
                </form>

                <form id="container-password-forget" class="container-login-form">
                    <div class="field-container">
                        <input id="forget-mail" name="email-forget" type="text" placeholder="Adresse email">
                    </div>

                    <input type="submit" class="login-submit" id="forget" value="Envoyer">
                    <a id="back-login-button" class="back-login-button button-login-page">
                        <span class="hover-link-center">Retour</span>
                    </a>
                </form>
            </span>
        </div>

        <script>
            var loginUrlPost = '<?php echo Helpers::getAdminRoute('login/login'); ?>';
            var loginResetPassword = '<?php echo Helpers::getAdminRoute('login/resetPassword'); ?>';
            var csrfToken = '<?php echo $csrfToken; ?>';
        </script>
        <script src="<?php echo Helpers::getAsset('js/login.js'); ?>"></script>
    </body>
</html>
