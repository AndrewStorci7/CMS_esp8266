<?php
session_start();
require_once('config.php');
require_once('settings_functions/visualizza_foto.php');
if(isset($_SESSION['session_id'])){
  $class = "text-white";
  $class2 = "text-white";
  $class3 = "text-white";
  $class4 = "text-white";
  $class5 = "text-white";

  if(isset($_GET['link']) && $_GET['link'] == 'userdata' || !isset($_GET['link'])){
    $class = 'active';
  } else if(isset($_GET['link']) && $_GET['link'] == 'alluserdata' || !isset($_GET['link'])){
    $class2 = 'active';
  } else if(isset($_GET['link']) && $_GET['link'] == 'profileallusers' || !isset($_GET['link'])){
    $class3 = 'active';
  } else if(isset($_GET['link']) && $_GET['link'] == 'settingsdisp' || !isset($_GET['link'])){
    $class4 = 'active';
  } else if(isset($_GET['link']) && $_GET['link'] == 'profile' || !isset($_GET['link'])){
    $class5 = 'active';
  }
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
    <meta name="keywords" content="ESP8266, esp, esp8266, arduino, CMS, panel, pannello di controllo, control panel, ARDUINO, WiFi, wifi, Project, progetto, scuola, school">
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
    <script type="text/javascript" src="../js/script.js?ts=<?=time()?>&quot"></script>
    <script type="text/javascript" src="../js/dropdown.js"></script>
    <link rel="stylesheet" href="../css/addcss.css?ts=<?=time()?>&quot">
    <link rel="stylesheet" href="../css/pannello_style.css?ts=<?=time()?>&quot">
  </head>
  <body>

    <main style="height:auto;">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 15%; height: 100% !important; position: fixed; z-index:9999 ;">
            <img src="../img/logo/logo_white_large.png" alt="">
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
              <li class="nav-item">
                <!--  -->
                <a href="?link=userdata" class="nav-link <?php echo $class;?>" id="home_nav">
                  <i class="fas fa-home"></i>
                  Data
                </a>
              </li>
              <?php
              if(isset($_SESSION['session_role']) && $_SESSION['session_role'] == 1){
               ?>
              <li>
                <!--  -->
                <a href="?link=alluserdata" class="nav-link <?php echo $class2; ?>" id="alluserdata_nav">
                  <i class="fas fa-chart-line"></i>
                  Users data
                </a>
              </li>
              <li>
                <!--  -->
                <a href="?link=profileallusers" class="nav-link <?php echo $class3; ?>" id="alluserprofile_nav">
                  <i class="fas fa-users-cog"></i>
                  Profiles users
                </a>
              </li>
              <?php
              }
               ?>
              <li>
                <!--  -->
                <a href="?link=settingsdisp" class="nav-link <?php echo $class4; ?>" id="settings_nav">
                  <i class="fas fa-cog"></i>
                  Settings
                </a>
              </li>
              <li>
                <!--  -->
                <a href="?link=profile" class="nav-link <?php echo $class5; ?>" id="profile_nav">
                  <img alt="Foto profilo" class="img_fotoprofilo" src="../<?php echo $addres; ?>" width="30px" height="30px">
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
        <div class="container-fluid bg-dark" style="position: fixed !important; padding: 10px; z-index: 9998">
          <div class="row">
            <div class="col-2">
            </div>
            <div class="col-9">
              <!-- ricerca -->
              <div class="container">
                <input class="form-control me-2 searchPannel" type="search" id="input-search" placeholder="Cerca un dato, nickname, data ..." aria-label="Search">
                <a href="javascript:void(0);" class="btn btn-outline-success" id="btn-search"><i class="fas fa-search"></i></a>
                <!-- al click scenderà un div che permetterà di scegliere altre opzioni per la ricerca -->
              </div>
            </div>
            <div class="col-1">
              <div id="main-nav">
                <ul class="fix_drop">
                    <li class="dropdown">
                        <a href="#" class="nav-item nav-link fix_link" data-toggle="dropdown">
                          <img src="../<?php echo $addres; ?>" class="img_fotoprofilo img_link" width="40px" height="40px">
                        </a>
                        <div class="dropdown-menu">
                            <a href="../index.html" class="dropdown-item">Home</a>
                            <a href="../access/php/logout.php" class="dropdown-item">Logout</a>
                            <a href="profile.php" class="dropdown-item">Settings</a>
                        </div>
                    </li>
                </ul>
              </div>

              <!--<button type="button" name="button" onclick="location.href='../access/php/logout.php'" class="btn btn-primary button-logout">
                <i class="fas fa-sign-out-alt"></i>
              </button>-->


              <!--<button type="button" name="see_graph" id="see_graph" >
                Vedi grafico
              </button>-->
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
