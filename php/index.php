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
    <link rel="shortcut icon" href="img/logo_small_icon_only.ico">
    <!--<link rel="stylesheet" href="cssFontawesome/all.css">-->
    <link rel="stylesheet" href="../bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../css/style_4.css?ts=<?=time()?>&quot">

    <script src="../bootstrap-5.1.3-dist/js/bootstrap.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://kit.fontawesome.com/2d628bcfce.js" crossorigin="anonymous"></script>
    <!-- FONT AWESOME DA MODIFICARE
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
    <script type="text/javascript" src="../js/script.js"></script>
    <script type="text/javascript" src="../js/dropdown.js"></script>
    <link rel="stylesheet" href="../css/addcss.css?ts=<?=time()?>&quot">
  </head>
  <body>

    <header>
      <div class="container-fluid">
        <div class="row">
          <div class="col-3">
            <h3 class="navbar-brand titoloHeader" style="color: #442AF5 !important;">Pannello</h3>
          </div>
          <div class="col-5">
            <!-- ricerca -->
                <form class="d-flex formSearchPannel">
                  <input class="form-control me-2 searchPannel" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                  <!-- al click scenderà un div che permetterà di scegliere altre opzioni per la ricerca -->
                  <!--<a href="#">Altre opzioni <i class="fas fa-sort-down"></i></a>-->
                </form>
          </div>
          <div class="col-3">
            <!-- mini menu per logout, o per tornare al menu -->

          </div>
          <div class="col-1">
            <!-- Qua ci sarà la foto profilo -->
            <a href="../access/php/logout.php">Logout</a>
          </div>
        </div>
      </div>
    </header>

    <main>
      <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
          <hr>
          <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
              <a href="#" class="nav-link active" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                Home
              </a>
            </li>
            <li>
              <a href="#" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                Dashboard
              </a>
            </li>
            <li>
              <a href="#" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                Orders
              </a>
            </li>
            <li>
              <a href="#" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                Products
              </a>
            </li>
            <li>
              <a href="#" class="nav-link text-white">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                Customers
              </a>
            </li>
          </ul>
          <hr>
          <div class="copyright">
            <center><p style="font-size: 10px;">Made by @Andrea Storci, 2022</p></center>
          </div>
        </div>
      </main>

    <main>
      <?php
        include_once('select.php');
       ?>
    </main>

  </body>
</html>
<?php
} else {
  header('Location: ../access/html/login_form.php');
}
 ?>
