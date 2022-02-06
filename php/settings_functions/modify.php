<?php
session_start();
require_once('../config.php');

$type = isset($_GET['type']) ? $_GET['type'] : "";
strval($type);

switch ($type) {
  case 'settings':
    $n_disp = isset($_POST['n_disp']) ? $_POST['n_disp'] : '';
    $id_disp = isset($_POST['id_disp']) ? $_POST['id_disp'] : '';
    $var1 = strval($n_disp);
    $var2 = intval($id_disp);
    $query = "UPDATE dispositivi
              SET n_disp = '" . $var1 . "' WHERE id_disp = " . $var2;
    $header = 'Location: ../settings.php';
    break;
  case 'profile':
    $nc = isset($_POST['nc']) ? $_POST['nc'] : '';
    $nick = isset($_POST['nick']) ? $_POST['nick'] : '';
    $var1 = strval($nc);
    $var2 = strval($nick);
    $query = "UPDATE utenti
              SET nc = '" . $var1 . "', nick = '" . $var2 . "'
              WHERE nick = '" . $_SESSION['session_user'] . "'";
    $header = 'Location: ../profile.php';
    break;
}
/*$query = "INSERT INTO tabella_file
          VALUES nome = '$nome_file_vero',
              tipo = '$tipo_file',
              dati = '$dati_file'";*/

if(($var1 == null || $var1 == 'undefined' || $var1 == "") || ($var2 == null || $var2 == 'undefined' || $var2 == "")){
  echo "<script>alert('Per modificare devi riempire il campo');</script>";
  header($header);
} else {
  $pdo->query($query);
  $_SESSION['session_user'] = $var2;
  header($header);
}





 ?>
