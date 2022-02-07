<?php
session_start();
require_once('../config.php');
if(isset($_SESSION['session_id'])){
  $n_disp_add = isset($_POST['n_disp']) ? $_POST['n_disp'] : '';
  $user_add = isset($_POST['nick_propietario']) ? $_POST['nick_propietario'] : '';
  $randomic = rand(1, 200);
  $select_u = "(SELECT id FROM utenti WHERE nick = :nick)";
  $query = "INSERT INTO dispositivi (id_disp, n_disp, id_u)
            VALUES (" . $randomic . ", :n_disp, " . $select_u . ")";
  $pre = $pdo->prepare($query);
  $pre->bindParam(':n_disp', $n_disp_add, PDO::PARAM_STR);
  $pre->bindParam(':nick', $user_add, PDO::PARAM_STR);
  if(empty($n_disp_add) || empty($user_add)){
    echo "I campi sono vuoti";
  } else {
    $pre->execute();
    header('Location: ../settings.php?msg=ok');
  }
  //da definire
} else {
  echo "non sei loggato";
}
 ?>
