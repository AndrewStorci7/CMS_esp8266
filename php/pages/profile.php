<?php
//session_start();
require_once('config.php');
require_once('settings_functions/visualizza_foto.php');
if(isset($_SESSION['session_id'])){
  $errormsg = isset($_GET['errormsg']) ? $_GET['errormsg'] : '';
  strval($errormsg);
  if($errormsg == 'nickesist'){
    echo "<script>alert('Il nickname inserito è già esistente');</script>";
  } else if($errormsg == 'riempireicampi'){
    echo "<script>alert('Per modificare devi riempire il campo');</script>";
  }
 ?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profile</title>
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
  </head>
  <body>
        <?php

        $role = isset($_SESSION['session_role']) ? $_SESSION['session_role'] : '2';
        switch ($role) {
          case 1:
            $query = "SELECT utenti.id, utenti.nc, utenti.nick, utenti.email, ruoli.nome_r, utenti.pw
                      FROM utenti JOIN ruoli
                      ON utenti.ruolo = ruoli.id
                      ORDER BY utenti.id";
            $display = "display: none;";
            $display2 = "display: block;";
            break;

          case 2:
            $query = "SELECT utenti.id, utenti.nc, utenti.nick, utenti.email, ruoli.nome_r, utenti.pw
                      FROM utenti JOIN ruoli
                      ON utenti.ruolo = ruoli.id
                      WHERE utenti.nick = '" . $_SESSION['session_user'] . "'";
            $display = "display: block;";
            $display2 = "display: none;";
            break;
        }


        echo "<div class='container' style='padding-top: 1%; padding-bottom: 10%;'>
                <center><h2 class='titolo_pagdispositivi'>Gestione profilo</h2></center>";

        $pre = $pdo->query($query);
        //include_once 'settings_functions/visualizza_foto.php';
        while($risultato = $pre->fetch()){
          echo '<div class="row div_dispositivi">
                  <h3 class="titolo_dispositivi">Impostazioni del profilo ' . $risultato['nc'] . '</h3>
                    <form enctype="multipart/form-data" method="post" action="settings_functions/foto.php?id_u=' . $risultato['id'] . '">
                      <label for="exampleInputEmail1" class="form-label">Foto profilo</label><br>
                      <input type="hidden" name="MAX_FILE_SIZE" value="300000">
                      <input type="file" name="foto"><br>
                      <input style="margin: 5px 5px 10px auto;" type="submit" name="upload" value="Salva">
                      <img src="../';
          $slc_all_foto = "SELECT nome_foto FROM utenti JOIN files ON utenti.foto = files.id WHERE utenti.id = " . $risultato['id'];
          $result_slc = $pdo->query($slc_all_foto);
          while($riga = $result_slc->fetch(PDO::FETCH_ASSOC)){
              $addres_all = $riga['nome_foto'];
              echo $addres_all;
          }
          echo '" width="200px" height="auto" style="float: right;">
                    </form>
                    <form method="post" action="settings_functions/modify.php?type=profile&id_u=' . $risultato['id'] . '">
                      <label for="exampleInputEmail1" class="form-label">Nome completo</label>
                      <input class="form-control" type="text" name="nc" value="' . $risultato['nc'] . '">

                      <label for="exampleInputEmail1" class="form-label">Nickname</label>
                      <input class="form-control" type="text" name="nick" value="' . $risultato['nick'] . '">
                      <label for="exampleInputEmail1" class="form-label">E-mail</label>
                      <input class="form-control" type="email" name="email" value="' . $risultato['email'] . '">
                      <label for="exampleInputEmail1" class="form-label">Ruolo</label>
                      <input style="' . $display . '" class="form-control" type="text" name="n_r" value="' . $risultato['nome_r'] . '" readonly>
                      <select style="' . $display2 . '" name="slc_role" class="form-select" aria-label="Scegli ruolo">
                        <option value="' . $risultato['nome_r'] . '" selected>' . $risultato['nome_r'] . '</option>';
                      if($_SESSION['session_role'] == 1){
                        $slc_roles = "SELECT nome_r FROM ruoli WHERE nome_r <> '" . $risultato['nome_r'] . "'";
                        $res = $pdo->query($slc_roles);
                        while($row = $res->fetch()){
                          echo "<option value='" . $row['nome_r'] . "'>" . $row['nome_r'] . "</option>";
                        }

                      }


          echo        '</select>
                      <p style="font-size: 12px; ' . $display . '">Solo l\'amministratore può modificare i permessi</p>
                      <br>
                      <button class="hoverlink modifica_button" alt="Modifica" type="submit" name="modifica"><i class="fas fa-user-edit"></i></button>
                    </form>
                </div>';
        }
        echo "</div>";
         ?>
  </body>
</html>

<?php
} else {
  header('Location: ../access/html/login_form.php');
}
 ?>
