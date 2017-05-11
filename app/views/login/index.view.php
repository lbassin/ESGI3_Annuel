<div class="container" style="height: 100vh;display: flex;align-items: center;justify-content: center;">
    <form class="container-login">
        <?php include 'app/assets/logo.html'; ?>
        <div class="field-container">
            <input type="text" name="email" placeholder="Identifiant">
        </div>
        <br>
        <div class="field-container">
            <input type="password" name="password" placeholder="Mot de passe">
        </div>

        <input type="submit" class="login-submit" value="Se connecter">
    </form>
</div>

<script>
    var loginUrlPost = '<?php echo Helpers::getAdminRoute('login/login'); ?>';
    var csrfToken = '<?php echo $csrfToken; ?>';
</script>

<script type="text/javascript" src="<?php echo Helpers::getAsset('js/login.js'); ?>"></script>