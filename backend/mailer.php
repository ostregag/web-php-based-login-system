<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require $_SERVER['backend'] . "/dane.php";
require $_SERVER['backend'] . "/config.php";
try {
$send_email = new PHPMailer(true);
    $send_email->isSMTP();
    $send_email->Port = 587;
    $send_email->Host = $EMAIL_SERVER;   //your mail server e.g smtp.gmail.com
    $send_email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $send_email->SMTPAuth = true;
    $send_email->Encoding = 'base64';
    $send_email->Username = $EMAIL_USERNAME;     //your username
    $send_email->Password = $EMAIL_PASSWORD;    //your password   
    $send_email->DKIM_selector = $EMAIL_DKIM_SELECTOR; //your dkim key name  in dns records        
    $send_email->DKIM_domain = $EMAIL_DKIM_DOMAIN;  //your domain      
    $send_email->DKIM_private = $EMAIL_DKIM_PRIVATE; //your dkim key path - without it mails will end up in spam
    $send_email->DKIM_passphrase = $EMAIL_DKIM_PASSPHRASE;    
$SEND_FROM_EMAIL = $EMAIL_SEND_FROM; // the email from which you want to send your verification links 
$account_ver_token = bin2hex(random_bytes(125));    
$account_ver_token_hash = hash('sha256', $account_ver_token);   



    $account_activation_link = "yourwebsite.com/verify.php?token=" . $account_ver_token;
    $send_email->addAddress($user); 
    $send_email->Subject = "Your verification link for the site";
    $send_email->Body = "Your verification link: " . $account_activation_link;
    $send_email->addReplyTo($SEND_FROM_EMAIL, "your_name");
    $send_email->setFrom($SEND_FROM_EMAIL, "your_name");
    //$send_email->setLanguage('lang', '/path/to/lang');
    $send_email->send();
    $sql_mail = "update $table set verify_token = ? where mail = ?";
$stmt_mail = $conn->prepare($sql_mail);
$stmt_mail->bind_param("ss", $account_ver_token_hash, $user );
$stmt_mail->execute();
$stmt_mail->close();
exit();
}
catch (Exception $e) {
    echo "error" . $send_email->ErrorInfo;
    $sent = false;
    exit();
}
 






?>






