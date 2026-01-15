    <?php
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header ("Location: login/index.html?badlink");
        die;
}


if (!isset($_POST["password"])) {
    header ("Location: login/index.html?badlink");
    die;
}
if (!isset($_COOKIE["reset_token"])) {
    header ("Location: login/index.html?badlink");
    die;
}
$pass_reset_cookie = hash('sha256',$_COOKIE["reset_token"]);
    require $_SERVER['backend'] . '/dane.php';
    $sql_mail_check = "SELECT mail FROM $table WHERE pass_reset_token = ?"  ;
    $stmt_mail_check = $conn->prepare($sql_mail_check);
    $stmt_mail_check->bind_param("s", $pass_reset_cookie);
    $stmt_mail_check->execute();
    $stmt_mail_check->bind_result($db_mail);
    $stmt_mail_check->fetch();
    $stmt_mail_check->close();

    $new_password_plain = (trim($_POST['password']));
    $new_password_hash = password_hash($new_password_plain, PASSWORD_BCRYPT);
    $sql_pass_upd = "UPDATE $table set password = ?, token = NULL, pass_reset_token = NULL where mail = ?";
    $stmt_pass_upd = $conn->prepare($sql_pass_upd);
    $stmt_pass_upd->bind_param("ss", $new_password_hash, $db_mail);
    $stmt_pass_upd->execute();
    $stmt_pass_upd->close();
    setcookie("reset_token", "", time() - 3600, "/", "", true, true);
    header("Location: login/index.html?password_changed_succesfully");
    exit();
    ?>