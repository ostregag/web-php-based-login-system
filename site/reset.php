<?php
if (!isset ($_COOKIE["reset_token"])) {
    header ("Location: login/index.html?badlink");
   exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
        <form action="pass_reset_finish.php" method="POST">
        <input id="password" type="password" name="password" placeholder="Your new password" required>
        <button type="submit">Register</button>
        </form>
        <script>
            const Url = new URLSearchParams(window.location.search);
            if (Url.has ('password_too_short')) { 
                document.write("password too short - minimum 8 characters");
            }
            </script>
</body>
</html>