<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Backoffice</title>
        <link rel="stylesheet" type="text/css" href="<?php echo Helpers::getAsset('css/admin.css'); ?>">
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
            $mail->addAddress('fabio.rocco@green-conseil.com');     // Add a recipient
            /*$mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');*/

            /*$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name*/
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if(!$mail->send()) {
                echo 'Message could not be sent.<br>';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }





        ?>
        <div class="container-login">
            <div class="login-container">
                <div class="brand">
                    <div class="logo">
                        <svg width="200px" height="200px" >
                            <path id="logo-circle-1" stroke="#000" stroke-width="0" fill="#a2a2a2" d="M140.773,59.227C137.316,55.771,130.055,50,100,50
                    s-37.317,5.771-40.774,9.227C55.77,62.684,49.999,69.104,50,100c-0.001,30.896,5.77,37.316,9.227,40.773
                    C62.683,144.229,69.103,150,100,150c30.895,0,37.317-5.771,40.772-9.227C144.229,137.316,150,130.896,150,100
                    S144.229,62.683,140.773,59.227z"/>

                            <path id="logo-circle-2" stroke="#000" stroke-width="0" fill="#a2a2a2" d="M140.773,59.227C137.316,55.771,130.055,50,100,50
                    s-37.317,5.771-40.774,9.227C55.77,62.684,49.999,69.104,50,100c-0.001,30.896,5.77,37.316,9.227,40.773
                    C62.683,144.229,69.103,150,100,150c30.895,0,37.317-5.771,40.772-9.227C144.229,137.316,150,130.896,150,100
                    S144.229,62.683,140.773,59.227z"/>
                        </svg>
                    </div>
                </div>
                <span id="container-login-form" class="container-login-form">
                    <div class="field-container">
                        <input type="text" placeholder="Identifiant">
                    </div>
                    <br>
                    <div class="field-container">
                        <input type="password" placeholder="Mot de passe">
                    </div>

                    <?php
                        $user = new User();
                        $this->includeModal('form', $user->getFormLogin());
                    ?>

                    <input type="submit" class="login-submit" value="Se connecter">
                    <a id="forget-password-button" class="link-password-forget button-login-page">
                        <span class="hover-link-center">Mot de passe oublié</span>
                    </a>

                    <?php
                    /* FABIO */
                        $user = new User();
                        $this->includeModal('form', $user->getFormLogin());
                    /**/
                    ?>
                </span>

                <span id="container-password-forget" class="container-login-form">
                    <div class="field-container">
                        <input type="password" placeholder="Adresse email">
                    </div>

                    <input type="submit" class="login-submit" value="Envoyer">
                    <a id="back-login-button" class="back-login-button button-login-page">
                        <span class="hover-link-center">Retour</span>
                    </a>
                </span>

            </div>



        </div>

        <script type="text/javascript" src="<?php echo Helpers::getAsset('js/admin.js'); ?>"></script>
    </body>
</html>