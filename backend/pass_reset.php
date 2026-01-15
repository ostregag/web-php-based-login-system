<?php
if (!isset($_GET['token'])) {
    
    exit();
}
$token = $_GET['token'];
if (!ctype_alnum($token)) {
    header ("Location: login/index.html?badlink");
    exit();
} 
$token_hash = hash('sha256', $token);
require $_SERVER['backend'] . '/dane.php';


$sql_ver = "SELECT mail from $table where pass_reset_token = ?";
$stmt_ver = $conn->prepare($sql_ver);
$stmt_ver->bind_param("s", $token_hash);
$stmt_ver->execute();
$stmt_ver->bind_result($db_mail);
$stmt_ver->fetch();


if (!$db_mail) {
    header ("Location: login/index.html?badlink");
    $stmt_ver->close();

    exit();
}
if ($db_mail) { 
    $_SESSION['mail_reset'] = $db_mail;
    setcookie ("reset_token", $token, time() + 60 * 60 * 1 * 1, "/", "", true, true);
    header ("Location: reset.php");
    $stmt_ver->close();
    exit();

}