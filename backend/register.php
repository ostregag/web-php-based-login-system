<?php

require $_SERVER['backend'] . '/dane.php';
require $_SERVER['backend'] . '/config.php';
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die;
}

if (!isset($_POST["email"]) || !isset($_POST["haslo"])) {
    die;
}
$password1 = trim($_POST["haslo"]);
$user = filter_var(trim ($_POST["email"]), FILTER_SANITIZE_EMAIL);
if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
    header("Location: index.html?bad_email");
    exit();

}
$ip_addr = $_SERVER['REMOTE_ADDR'];
//minimum 8 character password
if  (strlen($_POST["haslo"]) < 8) {
    header("Location: index.html?password_too_short");
    exit();
}
//rate limit - create account every five minutes from one ip
$sql_r_limit = "SELECT COUNT(*) FROM $table WHERE register_ip = ? AND created_at > (NOW() - INTERVAL 5 MINUTE)";
$stmt_rlimit = $conn->prepare($sql_r_limit);
$stmt_rlimit->bind_param("s", $ip_addr);
$stmt_rlimit->execute();
$stmt_rlimit->bind_result($r_limit);
$stmt_rlimit->fetch();
$stmt_rlimit->close();
if ($r_limit > 0) {
    header("Location: index.html?rate_limited");
    $conn->close();
    exit();
}

//check if the user already exists
$sql_sameusercheck = "SELECT COUNT(*) FROM $table WHERE mail = ?";
$stmt_sameusercheck = $conn->prepare($sql_sameusercheck);
$stmt_sameusercheck->bind_param("s", $user);
$stmt_sameusercheck->execute();
$stmt_sameusercheck->bind_result($sameuser);
$stmt_sameusercheck->fetch();
$stmt_sameusercheck->close();
if ( $sameuser > 0 ) { 
    header("Location: index.html?exists");
    $conn->close();
    exit();
};

$password = password_hash($password1, PASSWORD_BCRYPT);

$sql_insert = "INSERT INTO $table (mail, password, register_ip) VALUES (?, ?, ?)";
$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param("sss", $user, $password, $ip_addr);
$stmt_insert->execute();
$stmt_insert->close(); 
//mail account verification - OPTIONAL
if ($ENABLE_EMAIL_VERIFICATION == 1) {
require $_SERVER['backend'] . '/mailer.php';
}
header("Location: ../login/index.html?ok");
exit();
//hello ;3
?>



