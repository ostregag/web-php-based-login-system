<?php
require "check.php"; // this is required for every protected site 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Protected Site</title>
    <h1> this is your protected site - accesible only to logged in users</h1>
</head>
<body>
  <a href="logout.php" method="POST">logout</a>  
</body>


</html>
