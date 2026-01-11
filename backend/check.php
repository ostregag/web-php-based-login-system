<?php


if (!isset ($_COOKIE["logtoken"])) {
    header ("Location: ../login");
   exit();
}

require $_SERVER['backend'] . '/dane.php';
$sql = "SELECT mail FROM $table WHERE token = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param ("s", $_COOKIE['logtoken']);
$stmt->execute();
$stmt->bind_result($email);
$stmt->fetch();
$stmt->close();

if (!$email) {
    header("Location: ../login", true, 302);
    exit();

}

$_SESSION['user'] = $email;
$conn->close();
?>

