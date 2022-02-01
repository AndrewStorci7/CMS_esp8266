<?php
include_once('../php/login.php');
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="shortcut icon" href="../../img/logo_small_icon_only.ico">
        <link rel="stylesheet" href="../../bootstrap-5.1.3-dist/css/bootstrap.css">
        <link rel="stylesheet" href="../../css/style_2.css">
        <link rel="stylesheet" href="../../css/access_style.css">
    </head>
    <body>
      <div class="container-fluid">
        <center>
        <form method="post" action="../php/login.php">
            <h1>Login</h1>
            <input type="text" id="nick" placeholder="Nickname" name="nick" required>
            <?php echo $error1; ?>
            <input type="password" id="pw" placeholder="Password" name="pw" required>
            <?php echo $error2; ?>
            <?php echo $error3; ?>
            <button type="submit" name="login">Accedi</button>
            <center>
              <p>Se non sei registrato, <a href="register_form.php">registrati</a></p>
            </center>
            <br><br>
            <center>
              <a href="../../index.html" alt="Back home (Sono un fan di spiderman)">Torna alla home</a>
            </center>
        </form>
        </center>
      </div>
    </body>
</html>
