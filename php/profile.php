<?php
session_start();
require_once('config.php');
if(isset($_SESSION['session_id'])){
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
        <?php

        $role = isset($_SESSION['session_role']) ? $_SESSION['session_role'] : '2';
        switch ($role) {
          case 1:
            $query = "SELECT utenti.nc, utenti.nick, ruoli.nome_r, utenti.pw
                      FROM utenti JOIN ruoli
                      ON utenti.ruolo = ruoli.id
                      ORDER BY utenti.id";
            $display = "style='display: none;'";
            $display2 = "style='display: block;'";
            break;

          case 2:
            $query = "SELECT utenti.nc, utenti.nick, ruoli.nome_r, utenti.pw
                      FROM utenti JOIN ruoli
                      ON utenti.ruolo = ruoli.id
                      WHERE utenti.nick = '" . $_SESSION['session_user'] . "'";
            $readonly = "readonly";
            $display = "style='display: block;'";
            $display2 = "style='display: none;'";
            break;
        }


        echo "<div class='container' style='padding-top: 10%; padding-bottom: 10%;'>
                <center><h2 class='titolo_pagdispositivi'>Gestione profilo</h2></center>";


        $pre = $pdo->query($query);
        //include_once 'settings_functions/visualizza_foto.php';
        while($risultato = $pre->fetch()){
          echo '<div class="row div_dispositivi">
                  <h3 class="titolo_dispositivi">Impostazioni del profilo ' . $risultato['nc'] . '</h3>
                    <form enctype="multipart/form-data" method="post" action="settings_functions/foto.php">
                      <label for="exampleInputEmail1" class="form-label">Foto profilo</label><br>
                      <input type="hidden" name="MAX_FILE_SIZE" value="30000">
                      <input type="file" name="foto"><br>
                      <input style="margin: 5px 5px 10px auto;" type="submit" name="upload" value="Salva">
                    </form>
                    <form method="post" action="settings_functions/modify.php?type=profile">
                      <label for="exampleInputEmail1" class="form-label">Nome completo</label>
                      <input class="form-control" type="text" name="nc" value="' . $risultato['nc'] . '">

                      <label for="exampleInputEmail1" class="form-label">Nickname</label>
                      <input class="form-control" type="text" name="nick" value="' . $risultato['nick'] . '">
                      <label for="exampleInputEmail1" class="form-label">Ruolo</label>
                      <input class="form-control" type="text" name="n_r" value="' . $risultato['nome_r'] . '" ' . $readonly . '>
                      <p style="font-size: 12px">Solo l\'amministratore può modificare i permessi</p>
                      <br>
                      <button class="hoverlink modifica_button" alt="Modifica" type="submit" name="modifica"><i class="fas fa-user-edit"></i></button>
                    </form>
                </div>';
        }
        echo "</div>";
         ?>
    </header>
  </body>
</html>

<?php
} else {
  header('Location: ../access/html/login_form.php');
}
 ?>
