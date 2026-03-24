<?php   
//THIS IS THE CONFIG FILE
$ENABLE_EMAIL_VERIFICATION = 0;
$ENABLE_PASSWORD_RESET = 0;
$EMAIL_SERVER = ""; //your mail server e.g smtp.gmail.com
$EMAIL_PASSWORD = ""; //your password 
$EMAIL_USERNAME = ""; //your username
$EMAIL_DKIM_SELECTOR = ""; //your dkim key name  in dns records
$EMAIL_DKIM_DOMAIN = ""; //your domain  
$EMAIL_DKIM_PRIVATE = ""; //your dkim key path - without it mails will end up in spam
$EMAIL_DKIM_PASSPHRASE = ""; //self-explanatory
$EMAIL_SEND_FROM = ""; // the email from which you want to send your verification links 
?>