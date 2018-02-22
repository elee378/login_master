<?php
  ini_set('display_errors',1);
  error_reporting(E_ALL);

  require_once("phpscripts/config.php");

  $ip = $_SERVER["REMOTE_ADDR"];
  //echo $ip;

  if(isset($_POST['submit'])) {
    //echo "Thanks for clicking...";
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if($username != "" && $password != "") {
      $result = logIn($username, $password, $ip);
      $message = $result;
    }else{
      $message = "Please fill in the required fields.";
    }
  }
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../admin/css/app.css">
  </head>
  <body>

  <img src="images/logo_black.svg" id="logo">

  <p class="errorTxt"><?php if(!empty($message)){echo $message;} ?></p>
  <form action="admin_login.php" method="post">
    <input type="text" name="username" value="" placeholder="Username" id="username">
    <input type="password" name="password" value="" placeholder="Password" id="password">
    <input type="submit" name="submit" value="Show me what you've got." id="submit">
  </form>

  <div id="signup"><a href="admin_signup.php">Create a new user.</a></div>

  </body>
</html>