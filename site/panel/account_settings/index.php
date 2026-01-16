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
  if ($ENABLE_PASSWORD_RESET == 1) {
    echo '<a href="pass_reset_mailer.php">send password reset email</a>';
  }
  
  ?>
  <script>
            const Url = new URLSearchParams(window.location.search);
            if (Url.has ('success')) { 
                document.write("sent succesfully - check mail");
            }
  </script>

  </body>
  </html>