<?php
include_once('../php/register.php');
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registrazione</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="shortcut icon" href="../../img/logo_small_icon_only.ico">
        <link rel="stylesheet" href="../../css/style_2.css">
    </head>
    <body>
        <form method="post" action="../php/register.php">
            <h1>Registrazione</h1>
            <input type="text" id="nomecompleto" placeholder="Nome completo" name="nomecompleto" maxlength="50" required>
            <input type="text" id="nick" placeholder="Nickname" name="nick" maxlength="50" required>
            <?php echo $error1 . $error3 . $error5; ?>
            <input type="password" id="pw" placeholder="Password" name="pw" required>
            <?php echo $error2 . $error4 . $error6; ?>
            <button type="submit" name="register">Registrati</button>
            <center>
              <p>Se sei già registrato, <a href="login_form.php">accedi</a></p>
            </center>
            <br><br>
            <center>
              <a href="../../index.html" alt="Back home (Sono un fan di spiderman)">Torna alla home</a>
            </center>
        </form>
    </body>
</html>
