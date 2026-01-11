<?php

require $_SERVER['backend'] . '/dane.php';
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die;
}

if (!isset($_POST["email"]) || !isset($_POST["haslo"])) {
    die;
}

$user = filter_var(trim ($_POST["email"]), FILTER_SANITIZE_EMAIL);


$sql_sameusercheck = "SELECT COUNT(*) FROM $table WHERE mail = ?";
$stmt_sameusercheck = $conn->prepare($sql_sameusercheck);
$stmt_sameusercheck->bind_param("s", $_POST["email"]);
$stmt_sameusercheck->execute();
$stmt_sameusercheck->bind_result($sameuser);
$stmt_sameusercheck->fetch();
$stmt_sameusercheck->close();
if ( $sameuser > 0 ) { 
    header("Location: /register.html?istnieje");
    exit();
};

$password = password_hash(trim($_POST["haslo"]), PASSWORD_BCRYPT);

$sql_insert = "INSERT INTO $table (mail, password) VALUES (?, ?)";
$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param("ss", $user, $password);
$stmt_insert->execute();
$stmt_insert->close();

$conn->close();
header("Location: ../login/index.html?ok")

?>



