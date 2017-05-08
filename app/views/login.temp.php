<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Backoffice</title>
    <link rel="stylesheet" type="text/css" href="<?php echo Helpers::getAsset('css/login.css'); ?>">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>

<?php

//$mail = new Mail();
//$mail->send('maxime.marquet1@gmail.com', 'sujet', 'message');



require 'app/assets/lib/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 2;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'ssl0.ovh.net';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'noreply@qwarkz.fr';                 // SMTP username
$mail->Password = 'azertyuiop';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('noreply@qwarkz.fr', 'Qwarkz');
$mail->addAddress('maxime.marquet1@gmail.com');     // Add a recipient
/*$mail->addReplyTo('info@example.com', 'Information');
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');*/

/*$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name*/
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//if(!$mail->send()) {
if (false) {
    echo 'Message could not be sent.<br>';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>
<div class="container" style="height: 100vh;display: flex;align-items: center;justify-content: center;">
    <span class="container-login">
        <?php include 'app/assets/logo.html'; ?>
        <form id="container-login-form" class="container-login-form">
            <div class="field-container">
                <input type="text" placeholder="Identifiant">
            </div>
            <br>
            <div class="field-container">
                <input type="password" placeholder="Mot de passe">
            </div>

            <input type="submit" class="login-submit" value="Se connecter">
            <a id="forget-password-button" class="link-password-forget button-login-page">
                <span class="hover-link-center">Mot de passe oublié</span>
            </a>
        </form>

        <form id="container-password-forget" class="container-login-form">
            <div class="field-container">
                <input type="password" placeholder="Adresse email">
            </div>

            <input type="submit" class="login-submit" value="Envoyer">
            <a id="back-login-button" class="back-login-button button-login-page">
                <span class="hover-link-center">Retour</span>
            </a>
        </form>
    </span>
</div>
</div>

<script type="text/javascript" src="<?php echo Helpers::getAsset('js/login.js'); ?>"></script>
</body>
</html>