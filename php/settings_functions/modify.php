<?php
session_start();
require_once('../config.php');

$type = isset($_GET['type']) ? $_GET['type'] : "";
strval($type);

switch ($type) {
  case 'settings':
    $n_disp = isset($_POST['n_disp']) ? $_POST['n_disp'] : '';
    $id_disp = isset($_POST['id_disp']) ? $_POST['id_disp'] : '';
    $query = "UPDATE dispositivi
              SET n_disp = :n_disp WHERE id_disp = :id_disp";
    $pre = $pdo->prepare($query);
    $pre->bindParam(':n_disp', $n_disp, PDO::PARAM_STR);
    $pre->bindParam(':id_disp', $id_disp, PDO::PARAM_INT);
    $header = 'Location: ../settings.php';
    break;

  case 'profile':
    $nc = isset($_POST['nc']) ? $_POST['nc'] : '';
    $nick = isset($_POST['nick']) ? $_POST['nick'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $query = "UPDATE utenti
              SET nc = :nc, nick = :nick, email = :email
              WHERE nick = '" . $_SESSION['session_user'] . "'";
    $pre = $pdo->prepare($query);
    $pre->bindParam(':nc', $nc, PDO::PARAM_STR);
    $pre->bindParam(':nick', $nick, PDO::PARAM_STR);
    $pre->bindParam(':email', $email, PDO::PARAM_STR);
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
  $pdo->execute($query);
  $_SESSION['session_user'] = $var2;
  header($header);
}





 ?>
