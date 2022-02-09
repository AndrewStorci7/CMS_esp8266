<?php
require_once('../../php/config.php');

if (isset($_SESSION['session_id'])) {
    header('Location: ../../php/index.php?link=userdata');
    exit;
}

if (isset($_POST['login'])) {
    $nick = $_POST['nick']; //?? '';
    $password = $_POST['pw']; //?? '';

    if (empty($nick)) {
        //header('Location: ../html/login_form.php?msg=err1');
    } else if(empty($password)) {
        //header('Location: ../html/login_form.php?msg=err2');
    }else{
        $query = "
            SELECT nick, pw, ruolo
            FROM utenti
            WHERE nick = :nick
        ";

        $check = $pdo->prepare($query);
        $check->bindParam(':nick', $nick, PDO::PARAM_STR);
        //$check->bindParam(':pw', $pw, PDO::PARAM_STR);
        $check->execute();

        $user = $check->fetch(PDO::FETCH_ASSOC);

        if (!$user || ($user['pw'] != $password)) {
            //header('Location: ../html/login_form.php?msg=err3');
        } else {
            session_regenerate_id();
            $_SESSION['session_id'] = session_id();
            $_SESSION['session_user'] = $user['nick'];
            $_SESSION['session_role'] = $user['ruolo'];


            header('Location: ../../php/index.php?link=userdata');
            exit;
        }
    }
}

/*$msg = isset($_GET['msg']) ? $_GET['msg'] : "";
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
}*/
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
        <form class="form-floating" id="loginform" method="post" action="login_form.php">
            <h1>Login</h1>
            <input type="text" class="form-control" id="nick" placeholder="Nickname" name="nick" required>
            <input type="password" class="form-control" id="pw" placeholder="Password" name="pw" required>
            <p id="msg"></p>

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
