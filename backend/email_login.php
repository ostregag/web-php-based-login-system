<?php
if ($verified_status !== 'yes') {
    header("Location: index.html?notverified");
    $stmt_login->close();
    exit();
}
?>