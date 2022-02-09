<?php
require_once('../../php/config.php');

if (isset($_POST['register'])) {
    $error = array(
      'err_stat' => 0
    );

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

    if(empty($nc)){
        $error['err_stat'] = 1;
        $error['nc'] = 'Il campo nome completo è obbligatorio.';
    } else if (empty($nick)) {
        $error['err_stat'] = 1;
        $error['nick'] = 'Il campo Nickname è obbligatorio.';
    } elseif(empty($password)) {
        $error['err_stat'] = 1;
        $error['pw'] = 'Il campo Password è obbligatorio.';
    } elseif (false === $isNickValid) {
        $error['err_stat'] = 1;
        $error['nick'] = 'Il Nickname inserito non è valido.';
    } elseif ($pwdLenght < 8 || $pwdLenght > 20) {
        $error['err_stat'] = 1;
        $error['pw'] = 'la password deve essere più di 8 caratteri.';
    } else {
        $password_hash = md5(md5($password));
        //echo $password_hash;

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
            $error['err_stat'] = 1;
            $error['nick'] = 'Nickname o E-mail già in uso.';
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
                $response = array(
                  'stato' => 1,
                  'msg' => 'Registrazione avvenuta con successo!'
                );
            } else {
                $response = array(
                  'stato' => 0,
                  'msg' => 'Registrazione fallita!'
                );
            }
            echo json_encode($response);
            exit();
        }
    }

    if($error['err_stat'] > 0){
        echo json_encode($error);
        exit();
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
        <link rel="shortcut icon" href="../../img/logo_small_icon_only.ico">
        <!--<link rel="stylesheet" href="cssFontawesome/all.css">-->
        <link rel="stylesheet" href="../../bootstrap-5.1.3-dist/css/bootstrap.css">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <link rel="stylesheet" href="../../css/style_4.css?ts=<?=time()?>&quot">

        <script src="../../bootstrap-5.1.3-dist/js/bootstrap.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://kit.fontawesome.com/2d628bcfce.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="../../js/script.js"></script>
        <script type="text/javascript" src="../../js/dropdown.js?ts=<?=time()?>&quot"></script>
        <link rel="stylesheet" href="../../css/addcss.css?ts=<?=time()?>&quot">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="stylesheet" href="../../css/style_2.css">
        <link rel="stylesheet" href="../../css/access_style.css">
    </head>
    <body>
      <div class="container">
        <form id="register_form" method="post" action="">
            <h1>Registrazione</h1>
            <input type="text" id="nomecompleto" placeholder="Nome completo" name="nomecompleto" maxlength="50" required>
            <small id="ncerror"></small>

            <input type="text" id="nick" placeholder="Nickname" name="nick" maxlength="50" required>
            <small id="nickerror"></small>

            <input type="email" id="email" placeholder="E-mail" name="email" maxlength="50" required>
            <small id="emailerror"></small>

            <input type="password" id="pw" placeholder="Password" name="pw" required>
            <small  id="pwerror"></small>

            <button type="submit" id="submit" name="register">Registrati</button>
            <center>
              <p>Se sei già registrato, <a href="login_form.php">accedi</a></p>
            </center>
            <br><br>
            <center>
              <a href="../../index.html" alt="Back home (Sono un fan di spiderman)">Torna alla home</a>
            </center>
        </form>
      </div>
    </body>
</html>
