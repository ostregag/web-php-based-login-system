<?php

require $_SERVER['backend'] . '/dane.php';
require $_SERVER['backend'] . '/config.php';
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die;
}

if (!isset($_POST["email"]) || !isset($_POST["haslo"])) {
    die;
}

$user = trim ($_POST["email"]);
$haslo = trim ($_POST['haslo']);
$ip_addr_log = $_SERVER['REMOTE_ADDR'];


$sql_login = "SELECT password, verified FROM $table WHERE mail = ?";
$stmt_login = $conn->prepare($sql_login);
$stmt_login->bind_param ("s" , $user);
$stmt_login->execute();
$stmt_login->bind_result($szyfrowanehaslo, $verified_status);
$stmt_login->fetch();
$stmt_login->close(); 

//OPTIONAL EMAIL VER
if ($ENABLE_EMAIL_VERIFICATION == 1) {
require $_SERVER['backend'] . '/email_login.php';
} 

if ($szyfrowanehaslo && password_verify($haslo, $szyfrowanehaslo)) {

    $ciastko = bin2hex(random_bytes(125));
    $ciastko_hash = hash('sha256', $ciastko);

    $sql_update = "UPDATE $table SET token = ? WHERE mail = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param ("ss" , $ciastko_hash, $user);
    $stmt_update->execute();


    //insert login ip into the database
    $sql_insert_ip = "update $table set login_ip = ? where mail = ?";
    $stmt_insert_ip = $conn->prepare($sql_insert_ip);
    $stmt_insert_ip->bind_param("ss", $ip_addr_log, $user);
    $stmt_insert_ip->execute();
    $stmt_insert_ip->close();
    
    setcookie ("logtoken", $ciastko, time() + 60 * 60 * 24 * 7, "/", "", true, true);
    header("Location: ../panel");
    $conn->close();
    exit();



    

} else {
    header("Location: index.html?blad");
    $conn->close();
    exit();
    
}
?>