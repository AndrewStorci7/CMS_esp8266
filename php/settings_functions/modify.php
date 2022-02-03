<?php
require_once('../config.php');
$n_disp = isset($_POST['n_disp']) ? $_POST['n_disp'] : '';
$id_disp = isset($_POST['id_disp']) ? $_POST['id_disp'] : '';
$n_disp_cast = strval($n_disp);
$id_disp_cast = intval($id_disp);
$modify_query = "UPDATE dispositivi
                 SET n_disp = '" . $n_disp_cast . "' WHERE id_disp = " . $id_disp;
if($n_disp_cast == null || $n_disp_cast == 'undefined' || $n_disp_cast == "" || $id_disp_cast == 0){
  echo "<script>alert('Per modificare devi riempire il campo');</script>";
  header('Location: ../settings.php');
} else {
  $pdo->query($modify_query);
  header('Location: ../settings.php');
}
 ?>
