<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    function enviarEmail($email, $asunto, $cuerpo)
    {
        require_once './config/config.php';
        require_once './vendor/autoload.php';

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF; //SMTP::DEBUG_OFF;                   
            $mail->isSMTP();
            $mail->Host       = MAIL_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = MAIL_USER;
            $mail->Password   = MAIL_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = MAIL_PORT;

            //Recipients
            $mail->setFrom(MAIL_USER, 'DIOVIC ARTESANIA');

            $mail->addAddress($email);     //Add a recipient

            //Content
            $mail->isHTML(true);
            $mail->Subject = $asunto;



            $mail->Body    = $cuerpo;

            $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang-es.php');

            if ($mail->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Error al enviar el correo electronico de la compra: {$mail->ErrorInfo}";
            return false;
        }
    }
}
