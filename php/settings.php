<?php
session_start();
require_once('config.php');
if(isset($_SESSION['session_id'])){
 ?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Settings users</title>
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
    <script type="text/javascript" src="../js/dropdown.js"></script>
    <link rel="stylesheet" href="../css/addcss.css?ts=<?=time()?>&quot">
    <link rel="stylesheet" href="../css/pannello_style.css?ts=<?=time()?>&quot">
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
                            <a href="javascript:void();" class="nav-item nav-link" data-toggle="dropdown">Profile</a>
                            <div class="dropdown-menu">
                                <a href="access/php/logout.php" class="dropdown-item logoutCss">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <?php
    if(isset($_SESSION['session_role']) && $_SESSION['session_role'] == 1){
      echo "<div class='container' style='z-index: 99999 !important'>";
      $query = "SELECT dispositivi.n_disp, utenti.nc, utenti.nick
                FROM dispositivi JOIN utenti
                ON dispositivi.id_u = utenti.id";
      $pre = $pdo->query($query);
      while($risultato = $pre->fetch()){
        echo '<div class="row div_dispositivi">
                <h3 class="navbar_brand titoloHeader">Settings dispositivo di ' . $risultato['nc'] . '</h3>
                <form method="post" action="settings.php">
                  <input
                  <input class="form-control" type="text" id="n_disp" name="nick" value="' . $risultato['nick']. '"><br>
                  <label
                  <input type="text" id="nick" placeholder="Nickname" name="nick" >

                </form>
              </div>';
      }
      echo "</div>";
    } else if(isset($_SESSION['session_role']) && $_SESSION['session_role'] == 2){
     ?>

    <?php
    }
     ?>
   </header>
  </body>
</html>
<?php
}
?>
