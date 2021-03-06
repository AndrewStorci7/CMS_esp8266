<?php
session_start();
require_once('../../php/config.php');
if(!isset($_SESSION['session_id'])){
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
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
        <script src="https://kit.fontawesome.com/557a090e67.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="../../js/script.js?ts=<?=time()?>&quot"></script>
        <script type="text/javascript" src="../../js/dropdown.js?ts=<?=time()?>&quot"></script>
        <link rel="stylesheet" href="../../css/addcss.css?ts=<?=time()?>&quot">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="stylesheet" href="../../css/style_2.css?ts=<?=time()?>&quot">
        <link rel="stylesheet" href="../../css/access_style.css?ts=<?=time()?>&quot">
    </head>
    <body style="overflow-y: hidden !important;">
      <div class="container">
        <center>
        <form class="div_dispositivi mod_form" id="login_form" method="post" action="">
            <center>
              <img class="fix-imglogo-access" src="../../img/logo/logo_small.png" alt="Logo Esp panel">
            </center>
            <center><h3 class="titolo_dispositivi">Login</h3></center>
            <div class="errmsg"><i class='fa-solid fa-circle-exclamation'></i></div>
            <div class="form-floating mb-3">
                <input type="text" id="nick" class="form-control" placeholder="Nickname" name="nick" maxlength="50" required>
                <label for="floatingInput">Nickname</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" id="pw" class="form-control" placeholder="Password" name="pw" required>
                <label for="floatingInput">Password</label>
            </div>
            <div class="form-check" style="margin-bottom: 20px !important;">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="showPw()">
                <label class="form-check-label" id="label_check" for="flexCheckDefault">Vedi password</label>
            </div>

            <input class="button-submit" type="submit" id="submit" name="login" value="Accedi"><br>
            <center>
              <p class="link-page">Se non sei registrato, <a href="register_form.html">registrati</a></p>
            </center>
            <br><br>
            <center>
              <a href="../../index.html" alt="Back home (Sono un fan di spiderman)"><i class="fa-solid fa-house"></i> Torna alla home</a>
            </center>
        </form>
        </center>
      </div>
      <script type="text/javascript">
      $("#login_form").submit(function(){
        var nick = $("#nick").val();
        var pw = $("#pw").val();
        $.post("../php/login.php", {nick: nick, pw: pw}, function(risposta){
          console.log(risposta);
          var div_msg_err = $(".errmsg");
          if(risposta == 4){
            window.location = '../../php/index.php?link=userdata';
          } else if(risposta == 1){
            $("#nick").addClass('is-invalid');
            div_msg_err.addClass("add_display").html("<i class='fa-solid fa-circle-exclamation fix-fa'></i>Tutti i campi vanno compilati");
          } else if(risposta == 2){
            $("#pw").addClass('is-invalid');
            div_msg_err.addClass("add_display").html("<i class='fa-solid fa-circle-exclamation fix-fa'></i>Tutti i campi vanno compilati");
          } else if(risposta == 3){
            $("#nick").addClass('is-invalid');
            $("#pw").addClass('is-invalid');
            div_msg_err.addClass("add_display").html("<i class='fa-solid fa-circle-exclamation fix-fa'></i>Credenziali errate");
          }
        });
        return false;
      });
      </script>
    </body>
</html>
<?php
} else {
  header('Location: ../../php/index.php?link=userdata');
}
 ?>
