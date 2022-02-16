<?php
session_start();
require_once('../config.php');
if(isset($_SESSION['session_id'])){
  $role = $_SESSION['session_role'];
  switch ($role) {
    case 1:
      $user_add = filter_input(INPUT_POST, 'nick_propietario', FILTER_SANITIZE_STRING);
      break;

    case 2:
      $user_add = isset($_POST['nick_propietario']) ? $_POST['nick_propietario'] : '';
      break;
  }

  $n_disp_add = isset($_POST['n_disp']) ? $_POST['n_disp'] : '';
  $randomic = rand(1, 200);
  echo $randomic . "<br>";
  $check_id = "SELECT id_disp FROM dispositivi WHERE ";
  $select_u = "(SELECT id FROM utenti WHERE nick = :nick)";
  $query = "INSERT INTO dispositivi (id_disp, n_disp, id_u)
            VALUES (" . $randomic . ", :n_disp, " . $select_u . ")";
  $pre = $pdo->prepare($query);
  $pre->bindParam(':n_disp', $n_disp_add, PDO::PARAM_STR);
  $pre->bindParam(':nick', $user_add, PDO::PARAM_STR);
  if(empty($n_disp_add)){
    echo "Il nome del dispositivo è vuoto";
  } elseif (empty($user_add)) {
    echo "L'user è vuoto";
  } else {
    $pre->execute();
    header('Location: ../index.php?link=settingsdisp');
  }
  //da definire
} else {
  echo "non sei loggato";
}
 ?>
