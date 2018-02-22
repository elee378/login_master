<?php
    require_once("phpscripts/config.php");
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="css/app.css">
  </head>
  <body>

      <section class="">
          <div class="">
              <h2>Signup</h2>
              <form class="signup_form" action="phpscripts/signup_function.php" method="POST">
                  <input type="text" name="fname" placeholder="Firstname">
                  <input type ="text" name="lname" placeholder="Lastname">
                  <input type ="text" name="name" placeholder="Username">
                  <input type ="password" name="password" placeholder="Password">
                  <button type="submit" name="submit">Sign up</button>
              </form>
          </div>
      </section>

</body>
</html>