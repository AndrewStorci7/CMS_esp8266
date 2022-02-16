<?php
//session_start();
require_once('config.php');
if(isset($_SESSION['session_id'])){
  /*$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
  strval($msg);
  if($msg == 'ok'){
    echo "<script>alert('Dispositivo aggiunto con successo');</script>";
  }*/
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
    <script src="https://kit.fontawesome.com/557a090e67.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="../js/script.js"></script>
    <script type="text/javascript" src="../js/dropdown.js?ts=<?=time()?>&quot"></script>
    <link rel="stylesheet" href="../css/addcss.css?ts=<?=time()?>&quot">
  </head>
  <body>
    <?php
    $role = isset($_SESSION['session_role']) ? $_SESSION['session_role'] : '2';
    intval($role);
    switch ($role) {
      case 1:
        $query = "SELECT utenti.id, dispositivi.id_disp, dispositivi.n_disp, utenti.nc, utenti.nick
                  FROM dispositivi JOIN utenti
                  ON dispositivi.id_u = utenti.id";
        $titolo_pag = "Gestione dispositivi utenti";
        //$class_div = "";
        $delete = " ";
        break;

      case 2:
        $query = "SELECT utenti.id, dispositivi.id_disp, dispositivi.n_disp, utenti.nc, utenti.nick
                  FROM dispositivi JOIN utenti
                  ON dispositivi.id_u = utenti.id WHERE utenti.nick = '" . $_SESSION['session_user'] . "'";
        $titolo_pag = "Gestione dispositivo";
        //$class_div = "center_div";
        $delete = "display: none;";
        break;
    }
    echo "<div class='container' style='padding-top: 1%; padding-bottom: 10%;'>
            <center><h2 class='titolo_pagdispositivi'>" . $titolo_pag . "</h2></center>";
    $pre = $pdo->query($query);
    while($risultato = $pre->fetch()){
      echo '<div class="row div_dispositivi">
              <h3 class="titolo_dispositivi">Settings dispositivo di ' . $risultato['nc'] . '</h3>
                <form method="post" action="settings_functions/modify.php?type=settings">
                  <label for="exampleInputEmail1" class="form-label">Id dispositivo</label>
                  <input class="form-control" type="text" name="id_disp" value="' . $risultato['id_disp'] . '" readonly>
                  <p style="font-size: 12px">L\'id del dispositivo non può essere cambiato</p>
                  <label for="exampleInputEmail1" class="form-label">Nome dispositivo</label>
                  <input class="form-control" type="text" name="n_disp" value="' . $risultato['n_disp'] . '"><br>
                  <button class="hoverlink modifica_button" alt="Modifica" type="submit" name="modifica"><i class="fas fa-user-edit"></i></button>
                  <a class="hoverlink" alt="Elimina" style="float: right; color: rgb(230, 66, 30); font-size: 18px; padding: 10px; ' . $delete . '" onclick="deleteDisp( ' . $risultato['id_disp'] . ' )"><i class="fas fa-trash"></i></a>
                </form>
            </div>';
    }
    echo "
          <center><a style='color: green; font-size: 30px; text-decoration: none;' href='#form_aggiungi' onclick='seeAggiungi()'>Aggiungi dispositivo <i class='fas fa-plus'></i></a></center>
        </div>";
    ?>

    <div class="container" style="margin-bottom: 200px; padding-bottom: 10px;">
      <div class="row div_dispositivi" id="form_aggiungi">
        <form action="settings_functions/add_disp.php" method="post">
          <label for="exampleInputEmail1" class="form-label">Id dispositivo</label>
          <input class="form-control" type="text" name="id_disp" placeholder="L'id verrà assegnato automaticamente" readonly>
          <label for="exampleInputEmail1" class="form-label">Nome dispositivo</label>
          <input class="form-control" type="text" name="n_disp" placeholder="Nome dispositivo"><br>
          <label for="exampleInputEmail1" class="form-label">Propietario</label>

            <?php
            if(isset($_SESSION['session_role']) && $_SESSION['session_role'] == 1){
              echo '<select name="nick_propietario" class="form-select" aria-label="Scegli utente">
                <option selected>Scegli un utente</option>';
              $select_u = "SELECT nick
                           FROM utenti";
              $res_select = $pdo->query($select_u);
              while($righe = $res_select->fetch(PDO::FETCH_ASSOC)){
                echo "<option  value='" . $righe['nick'] . "'>" . $righe['nick'] . "</option>";
              }
            } elseif (isset($_SESSION['session_role']) && $_SESSION['session_role'] == 2){
              echo '<input class="form-control" type="text" name="nick_propietario" value="' . $_SESSION['session_user'] . '" readonly><br>';
            }
             ?>
          </select>
          <button style="background-color: rgba(60, 202, 38, 0.8); border-radius: 0 0 5px 5px" class="hoverlink modifica_button" alt="Aggiungi" type="submit" name="aggiungi"><i style="color: rgb(0, 100, 0)" class="fas fa-plus"></i></button>
        </form>
      </div>
    </div>
  </body>
</html>
<?php
} else {
  header('Location: ../access/html/login_form.html');
}
?>
