<?php

require $_SERVER['backend'] . '/dane.php';

if (!isset($_COOKIE["logtoken"])) {
    exit();

}
$token = $_COOKIE['logtoken'];

$sql = "SELECT id FROM $table WHERE token = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();
$stmt->bind_result($idusera);
$stmt->fetch();
$stmt->close();

$sql2 = "update $table set token = NULL where id = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("s", $idusera);
$stmt2->execute();
    
$stmt2->close();
    
setcookie("logtoken", "", time() - 3600, "/", "", true, true);
header("Location: ../login");
$conn->close();
exit();
   
?>
