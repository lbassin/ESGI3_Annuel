<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Backoffice</title>
    <link rel="stylesheet" type="text/css" href="<?php echo Helpers::getAsset('css/login.css'); ?>">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
<div class="container" style="height: 100vh;display: flex;align-items: center;justify-content: center;">
    <div class="container-login">
        <?php include 'app/assets/logo.html'; ?>
        <div class="field-container">
            <input type="text" placeholder="Identifiant">
        </div>
        <br>
        <div class="field-container">
            <input type="password" placeholder="Mot de passe">
        </div>

        <input type="submit" class="login-submit" value="Se connecter">
    </div>
</div>

<script type="text/javascript" src="<?php echo Helpers::getAsset('js/admin.js'); ?>"></script>
</body>
</html>
