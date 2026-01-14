<?php
if (!isset($_GET['token'])) {
    
    exit();
}
$token = $_GET['token'];
if (!ctype_alnum($token)) {
    header ("Location: login/index.html?badlink");
    exit();
} 
require $_SERVER['backend'] . '/dane.php';

$sql_ver = "SELECT mail from $table where verify_token = ? and verified = 'no' LIMIT 1";
$stmt_ver = $conn->prepare($sql_ver);
$stmt_ver->bind_param("s", $token);
$stmt_ver->execute();
$stmt_ver->bind_result($db_mail);
$stmt_ver->fetch();
$stmt_ver->close();

if (!$db_mail) {
    header ("Location: login/index.html?badlink");
    $stmt_ver->close();
    $conn->close();
    exit();
}
if ($db_mail) { 
    $sql_ver_upd = "UPDATE $table set verified = 'yes', verify_token = NULL where mail = ?";
    $stmt_ver_upd = $conn->prepare($sql_ver_upd);
    $stmt_ver_upd->bind_param("s", $db_mail);
    $stmt_ver_upd->execute();
    $stmt_ver_upd->close();
    header("Location: login/index.html?verified_succesfully");
    $conn->close();
    exit();
}

