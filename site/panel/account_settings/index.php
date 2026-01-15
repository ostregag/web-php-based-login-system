  <?php
  require $_SERVER['backend'] . '/check.php';
  require $_SERVER['backend'] . '/config.php';
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
  <?php 
  If ($ENABLE_EMAIL_VERIFICATION == 1) {
    echo '<a href="pass_reset_mailer.php">send password reset email</a>';
  }
  ?>

  </body>
  </html>