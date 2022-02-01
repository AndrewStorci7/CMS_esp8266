<?php
session_start();
require_once('config.php');
if(isset($_SESSION['session_id'])){
?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pannello di controllo</title>
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

    <main style="height:auto;">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 15%; height: 100% !important; position: fixed; z-index:9998 ;">
            <br>
            <br>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
              <li class="nav-item">
                <a href="?link=userdata" class="nav-link active" id="home_navbar" onclick="paginaSelector(this.id)">
                  <i class="fas fa-home"></i>
                  Home
                </a>
              </li>
              <li>
                <a href="#" class="nav-link text-white" id="data_navbar" onclick="paginaSelector(this.id)">
                  <i class="far fa-chart-bar"></i>
                  Data
                </a>
              </li>
              <li>
                <a href="#" class="nav-link text-white" id="settings_navbar" onclick="paginaSelector(this.id)">
                  <i class="fas fa-cog"></i>
                  Settings
                </a>
              </li>
              <li>
                <a href="?link=alluserdata" class="nav-link text-white" id="alluserdata_navbar" onclick="paginaSelector(this.id)">
                  <i class="fas fa-chart-line"></i>
                  Users data
                </a>
              </li>
              <li>
                <a href="#" class="nav-link text-white" id="profile_navbar" onclick="paginaSelector(this.id)">
                  <!-- INSERIRE LA FOTO PROFILO DELL'UTENTE -->
                  Profile
                </a>
              </li>
            </ul>
            <hr>
            <div class="copyright">
              <center><p style="font-size: 10px;">Made by @Andrea Storci, 2022</p></center>
            </div>
          </div>
      </main>
      <header>
        <div class="container-fluid bg-dark" style="position: fixed !important; padding: 10px; z-index: 9999">
          <div class="row">
            <div class="col-2">
              <h3 class="navbar-brand titoloHeader" style="color: #0D6EFD !important; ">Pannello</h3>
            </div>
            <div class="col-9">
              <!-- ricerca -->
              <div class="container">
                  <form class="d-flex formSearchPannel">
                    <input class="form-control me-2 searchPannel" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                    <!-- al click scenderà un div che permetterà di scegliere altre opzioni per la ricerca -->
                    <!--<a href="#">Altre opzioni <i class="fas fa-sort-down"></i></a>-->
                  </form>
              </div>
            </div>
            <div class="col-1">
              <!-- Qua ci sarà la foto profilo -->
              <button type="button" name="button" onclick="location.href='../access/php/logout.php'" class="btn btn-primary button-logout">
                <i class="fas fa-sign-out-alt"></i>
              </button>
              <button type="button" name="see_graph" id="see_graph" >
                Vedi grafico
              </button>
            </div>
          </div>
        </div>
      </header>

      <section class="modificaFix">
      <?php
        include_once('select.php');
       ?>
      </section>

  </body>
</html>
<?php
} else {
  header('Location: ../access/html/login_form.php');
}
 ?>
