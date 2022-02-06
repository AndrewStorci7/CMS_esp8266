<?php
include_once('../php/login.php');

$msg = isset($_GET['msg']) ? $_GET['msg'] : "";
strval($msg);
$errmsg = "";
$classerr = "";
switch ($msg) {
  case 'err3':
    $errmsg = "<p style='color: red; font-size: 12px;'>Credenziali errate</p>";
    $classerr = "is-invalid";
    break;

  case 'err2':
    $errmsg = "<p style='color: red; font-size: 12px;'>Inserire la password</p>";
    $classerr = "is-invalid";
    break;

  case 'err1':
    $errmsg = "<p style='color: red; font-size: 12px;'>Inserire il nickname</p>";
    $classerr = "is-invalid";
    break;
}
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
        <form class="form-floating" method="post" action="../php/login.php">
            <h1>Login</h1>
            <input type="text" class="form-control <?php echo $classerr; ?> " id="nick" placeholder="Nickname" name="nick" required>
            <input type="password" class="form-control <?php echo $classerr; ?> " id="pw" placeholder="Password" name="pw" required>
            <?php echo $errmsg; ?>
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
