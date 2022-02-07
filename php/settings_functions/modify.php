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
    if((empty($n_disp) || $n_disp == 'undefined') || ($id_disp == 0)){
      echo "<script>alert('Per modificare devi riempire il campo');</script>";
      header($header);
    }
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
    if((empty($nc) || $nc == 'undefined') || (empty($nick) || $nick == 'undefined') || (empty($email) || $email == 'undefined')){
      echo "<script>alert('Per modificare devi riempire il campo');</script>";
      header($header);
    }
    break;
}
  $pdo->execute($query);
  $_SESSION['session_user'] = $var2;
  header($header);
}





 ?>
