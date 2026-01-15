  <?php
  require $_SERVER['backend'] . '/check.php';
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="../style.css">
  </head>

  <body>
  <h1>account settings for: <?php echo $email ?></h1>
  <a href="pass_reset_index.php">reset password</a>
  </body>
  </html>