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

        <div class="container">
            <?php include $this->view; ?>
        </div>
        <script>
            var loginIndex = '<?php echo Helpers::getAdminRoute('login/index'); ?>';
            var loginUrlPost = '<?php echo Helpers::getAdminRoute('login/login'); ?>';
            var loginResetPassword = '<?php echo Helpers::getAdminRoute('login/resetPassword'); ?>';
            var loginValidateResetPassword = '<?php echo Helpers::getAdminRoute('login/validateResetPassword'); ?>';
            var csrfToken = '<?php echo $csrfToken; ?>';
        </script>
        <script src="<?php echo Helpers::getAsset('js/login.js'); ?>"></script>
    </body>
</html>
