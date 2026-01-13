<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$send_email = new PHPMailer(true);
    $send_email->isSMTP();
    $send_email->Port = 587;
    $send_email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $send_email->SMTPAuth = true;
    $send_email->Encoding = 'base64';
    $send_email->host = "smtp.gmail.com";   //your mail server e.g smtp.gmail.com
    $send_email->Username = '';     //your username
    $send_email->Password = '';    //your password   
    $send_email->DKIM_selector = ''; //your dkim key name  in dns records        
    $send_email->DKIM_domain = '';  //your domain      
    $send_email->DKIM_private = ''; //your dkim key path - without it mails will end up in spam
    $send_email->DKIM_passphrase = '';    
$SEND_FROM_EMAIL = "your@email.com";            
    
$account_ver_token = bin2hex(random_bytes(125));

    $account_activation_link = "YourDomain.com/verify.php?token=" . $account_ver_token;
    $send_email->addAddress($user); 
    $send_email->Subject = "Your verification link for site";
    $send_email->Body = "Your verification link: " . $account_activation_link;
    $send_email->addReplyTo($SEND_FROM_EMAIL, "your_name");
    $send_email->setFrom($SEND_FROM_EMAIL, "your_name");
    $send_email->setLanguage('lang', '/path/to/lang');
    $send_email->send();

?>






