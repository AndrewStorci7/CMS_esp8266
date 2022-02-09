<?php
//include_once('../php/register.php');
require_once('../../php/config.php');
$error1 = '';
$error2 = '';
$error3 = '';
$error4 = '';
$error5 = '';
$error6 = '';

if (isset($_POST['register'])) {
    $nc = $_POST['nomecompleto']; //?? '';
    $nick = $_POST['nick']; //?? '';
    $password = $_POST['pw']; //?? '';
    $email = $_POST['email'];
    $isEmailValid = filter_var(
        $email,
        FILTER_VALIDATE_EMAIL
    );
    $isNickValid = filter_var(
        $nick,
        FILTER_VALIDATE_REGEXP, [
            "options" => [
                "regexp" => "/^[a-z\d_]{3,20}$/i"
            ]
        ]
    );
    /*$isNcValid = filter_var(
        $nc,
        FILTER_VALIDATE_REGEXP, [
            "options" => [
                "regexp" => "/^[a-z\d_]$/i"
            ]
        ]
    );*/
    $pwdLenght = mb_strlen($password);

    if (empty($nick)) {
        $error1 = '<p class="error">Inserire il nickname</p>';
        //header('Location: ../html/register_form.php');
    } elseif(empty($password)) {
        $error2 = '<p class="error">Inserire la password</p>';
        //header('Location: ../html/register_form.php');
    } elseif (false === $isNickValid) {
        $error3 = '<p class="error">L\'username non è valido</p>';
        //header('Location: ../html/register_form.php');
    } elseif ($pwdLenght < 8 || $pwdLenght > 20) {
        $error4 = '<p class="error">La password deve essere di almeno 8 caratteri</p>';
        //header('Location: ../html/register_form.php');
    } else {
        $password_hash = md5(md5($password));
        echo $password_hash;

        $query = "
            SELECT id
            FROM utenti
            WHERE email = :email OR nick = :nick";

        $check = $pdo->prepare($query);
        $check->bindParam(':email', $email, PDO::PARAM_STR);
        $check->bindParam(':nick', $nick, PDO::PARAM_STR);
        $check->execute();

        $user = $check->fetchAll(PDO::FETCH_ASSOC);

        if (count($user) > 0) {
            $error5 = '<p class="error">Nickname già in uso</p>';
            //header('Location: ../html/register_form.php');
        } else {
            $query = "
                INSERT INTO utenti(nick, email, pw, nc)
                VALUES (:nick, :email, :pw, :nomecompleto)
            ";

            $check = $pdo->prepare($query);
            $check->bindParam(':email', $email, PDO::PARAM_STR);
            $check->bindParam(':nick', $nick, PDO::PARAM_STR);
            $check->bindParam(':pw', $password_hash, PDO::PARAM_STR);
            $check->bindParam(':nomecompleto', $nc, PDO::PARAM_STR);
            $check->execute();

            if ($check->rowCount() > 0) {
                //header('Location: ../html/login_form.php');
            } else {
                $error6 = '<p class="error">Problemi con l\'inserimento dei dati</p>';
                //header('Location: ../html/register_form.php');
            }
        }
    }
}
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registrazione</title>
        <meta description="refresh" content="0; url=http://example.com">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=7">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="ESP8266, esp, esp8266, arduino, CMS, pannell, pannello di controllo, control pannell, ARDUINO, WiFi, wifi, Project, progetto, scuola, school">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../img/logo_small_icon_only.ico">
        <!--<link rel="stylesheet" href="cssFontawesome/all.css">-->
        <link rel="stylesheet" href="../bootstrap-5.1.3-dist/css/bootstrap.css">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <link rel="stylesheet" href="../css/style_4.css?ts=<?=time()?>&quot">

        <script src="../bootstrap-5.1.3-dist/js/bootstrap.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://kit.fontawesome.com/2d628bcfce.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/dropdown.js?ts=<?=time()?>&quot"></script>
        <link rel="stylesheet" href="../css/addcss.css?ts=<?=time()?>&quot">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="stylesheet" href="../../css/style_2.css">
<<<<<<< Updated upstream
    </head>
    <body>
      <header class="header-area">
          <nav class="navbar navbar-expand-md navbar-dark">
              <div class="container">
                  <h3 class="navbar_brand titoloHeader">ESP pannell</h3>

                  <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#main-nav" id="menu_side">
                      <span class="menu-icon-bar">Home</span>
                      <span class="menu-icon-bar">About Me</span>
                      <span class="menu-icon-bar">Profile</span>
                      <span class="menu-icon-bar">Contact</span>
                  </button>

                  <div id="main-nav" class="collapse navbar-collapse">
                      <ul class="navbar-nav fixed ml-auto fixed">
                          <li><a href="../index.html" class="nav-item nav-link">Home</a></li>
                          <li><a href="index.php" class="nav-item nav-link">Torna al pannello</a></li>
                          <li class="dropdown">
                              <a href="javascript:void(0);" class="nav-item nav-link" data-toggle="dropdown">Profile</a>
                              <div class="dropdown-menu">
                                  <a href="../access/php/logout.php" class="dropdown-item logoutCss">Logout</a>
                              </div>
                          </li>
                      </ul>
                  </div>
              </div>
          </nav>
        <form method="post" action="../php/register.php">
=======
        <link rel="stylesheet" href="../../css/access_style.css">
    </head>
    <body>
      <div class="container">
        <form id="#registerform" method="post" action="register_form.php">
>>>>>>> Stashed changes
            <h1>Registrazione</h1>
            <input type="text" id="nomecompleto" placeholder="Nome completo" name="nomecompleto" maxlength="50" required>
            <input type="text" id="nick" placeholder="Nickname" name="nick" maxlength="50" required>
            <?php echo $error1 . $error3 . $error5; ?>
            <input type="email" id="nick" placeholder="E-mail" name="email" maxlength="50" required>
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
<<<<<<< Updated upstream
      </header>
=======
      </div>
>>>>>>> Stashed changes
    </body>
</html>
