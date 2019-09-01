<?php
require_once('functions/phpmailer-function.php');

function sendResetPasswordEmail($email, $username, $code, $id){

    $link = "http://localhost/xvlox/reset-password.php?transaction=$id&code=$code";
    $body = file_get_contents('emails/reset-password-email.html');
    $body = str_replace('%username%', $username, $body);
    $body = str_replace('%link%', $link, $body);
    $subject = 'Reset Password - XvloX.com';

    phpMailer($email, $username, $code, $id, $body, $subject);
}

function sendWelcomeEmail($email, $username, $code, $id){

    $link = "http://localhost/xvlox/verify-email.php?transaction=$id&code=$code";
    $body = file_get_contents('emails/welcome-email.html');
    $body = str_replace('%username%', $username, $body);
    $body = str_replace('%link%', $link, $body);
    $subject = 'Welcome to XvloX.com';

    phpMailer($email, $username, $code, $id, $body, $subject);
}