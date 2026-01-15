  <?php
  require $_SERVER['backend'] . '/check.php';
  $user = $email;
  require $_SERVER['backend'] . '/pass_reset_mailer.php';
  ?>