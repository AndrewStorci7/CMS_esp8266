<?php
require_once('../../php/config.php');

if (isset($_POST['submit'])) {

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
        $error = 1;
        // nomecompleto vuoto
    } else if (empty($nick)) {
        $error = 2;
        // nick vuoto
    } else if(empty($password)) {
        $error = 3;
        //pw vuota
    } else if(empty($email)) {
        $error = 4;
        // email vuota
    } else if (false === $isNickValid) {
        $error = 5;
        // nickname non valido
    } else if ($pwdLenght < 8 || $pwdLenght > 20) {
        $error = 6;
        // passowrd corta o troppo lunga
    } else {
        $password_hash = md5(md5($password));

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
            $error = 7;
            //nickname o email già in uso
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
                $error = 0;
                //registrazione riuscita
            } else {
                //registrazione fallita
                $error = 9;
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
<script type="text/javascript">
//al click sul bottone "Login" del form----
$(document).ready(function(){
  $('#submit').click(function(){
      var nc = $("#nomecompleto").val();
      var nick = $("#nick").val();
      var email = $("#email").val();
      var pw = $("#pw").val();
      var credenziali = 'nc=' + nc + '&nick=' + nick + '&email=' + email + '&pw=' + pw;

      //chiamata ajax al controllo credenziali
      $.ajax({
          type: "POST",
          url: "register_form.php",
          data: credenziali,
          success: function(risposta){
              if(risposta > 0){
                  alert("Credenziali non valide");
              } else if(risposta == 0) {
                alert("Credenziali  valide, Complimenti");
                /* se le credenziali sono valide al posto del messaggio si richiama la pagina a cui si vole accedere con ad esempio:  window.location = "index.php";*/
              }
              //document.getElementById("register_form").reset();
          },
          error: function(){
              alert("Chiamata AJAX fallita");
          }

      });
      return false;
  });
});
</script>

    </head>
    <body>
      <div class="container">
        <form id="register_form" method="post" action="">
            <h1>Registrazione</h1>
            <input type="text" id="nomecompleto" placeholder="Nome completo" name="nomecompleto" maxlength="50" required>
            <!--<small id="ncError"></small>-->

            <input type="text" id="nick" placeholder="Nickname" name="nick" maxlength="50" required>
            <!--<small id="nickError"></small>-->

            <input type="email" id="email" placeholder="E-mail" name="email" maxlength="50" required>
            <!--<small id="emailError"></small>-->

            <input type="password" id="pw" placeholder="Password" name="pw" required>
            <div id="errormessage"></div>

            <input type="submit" id="submit" name="submit" value="Registrati">
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
