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
            $mail->Subject = 'Detalle de su compra';

            $cuerpo = '<h4>Gracias por su compra</h4>';
            $cuerpo.= '<p>El ID de su compra es <b>'. $id_transaccion. '</b></p>';



            $mail->Body    = $cuerpo;
            $mail->AltBody = 'Le enviamos los detalles de su compra.';

            $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang-es.php');

            $mail->send();
                
        } catch (Exception $e) {
            echo "Error al enviar el correo electronico de la compra: {$mail->ErrorInfo}";
            exit;
        }
    }
}
