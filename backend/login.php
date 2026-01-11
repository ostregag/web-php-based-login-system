<?php

require $_SERVER['backend'] . '/dane.php';
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die;
}

if (!isset($_POST["email"]) || !isset($_POST["haslo"])) {
    die;
}

$user = trim ($_POST["email"]);
$haslo = trim ($_POST['haslo']);


$sql_login = "SELECT password FROM $table WHERE mail = ?";
$stmt_login = $conn->prepare($sql_login);
$stmt_login->bind_param ("s" , $user);
$stmt_login->execute();
$stmt_login->bind_result($szyfrowanehaslo);

$stmt_login->fetch();
$stmt_login->close();

if ($szyfrowanehaslo && password_verify($haslo, $szyfrowanehaslo)) {

    $ciastko = bin2hex(random_bytes(125));

    $sql_update = "UPDATE $table SET token = ? WHERE mail = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param ("ss" , $ciastko, $user);
    $stmt_update->execute();
    $stmt_update->close();
    
    setcookie ("logtoken", $ciastko, time() + 60 * 60 * 24 * 7, "/", "", true, true);
    header("Location: ../panel");
    $conn->close();
    exit();



    

} else {
    header("/index.html?blad");
    $conn->close();
    exit();
    
}
?>