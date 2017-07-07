<div id="popup-message">

</div>

<span class="container-login">
    <?php include 'app/assets/logo.html'; ?>
    <form method="post" id="container-login-form" class="container-login-form">
        <div class="field-container">
            <input type="password" name="new-password" placeholder="Mot de passe" autofocus>
        </div>
        <br>
        <div class="field-container">
            <input type="password" name="new-password-confirmation" placeholder="Confirmation">
        </div>

        <input type="submit" class="login-submit" id="validate-reset-password" value="Réinitialiser">
        <a href="<?php echo Helpers::getAdminRoute('login/index'); ?>" class="link-password-return button-login-page">
            <span class="hover-link-center">Annuler</span>
        </a>
    </form>
</span>