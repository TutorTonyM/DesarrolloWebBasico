<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function phpMailer($email, $username, $code, $id, $body, $subject){
    require_once('vendor/PHPMailer/src/Exception.php');
    require_once('vendor/PHPMailer/src/PHPMailer.php');
    require_once('vendor/PHPMailer/src/SMTP.php');
    $mail = new PHPMailer(true);
    try {
        //Servidor
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = 'in-v3.mailjet.com';
        $mail->SMTPAuth = true;
        $mail->Username = '71f65ad9364dd67ff096e28fee2c67b5';
        $mail->Password = '02ed55365b55dbd7116cd653d35874b2';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        //Usuarios
        $mail->setFrom('testing@mastersdeveloping.com', 'XvloX.com');
        $mail->addAddress($email, $username);
        //Contenido
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->send();
    } catch (Exception $e) {
        echo 'The Email could not be sent: '. $mail->ErrorInfo;
    }
}