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
    $header = 'Location: ../index.php?link=settingsdisp';
    if((empty($n_disp) || $n_disp == 'undefined') || ($id_disp == 0)){
      echo "<script>alert('Per modificare devi riempire il campo');</script>";
      header($header);
    }
    break;

  case 'profile':
    $nc = isset($_POST['nc']) ? $_POST['nc'] : '';
    $nick = isset($_POST['nick']) ? $_POST['nick'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $get_id = isset($_GET['id_u']) ? $_GET['id_u'] : '';
    $header = 'Location: ../index.php?link=profile';
    if($_SESSION['session_role'] == 1){
        intval($get_id);
        $user_role = filter_input(INPUT_POST, 'slc_role', FILTER_SANITIZE_STRING);
        $slc_id_role = "(SELECT id FROM ruoli WHERE nome_r = '" . $user_role . "')";
        $query = "UPDATE utenti
                  SET nc = :nc, nick = :nick, email = :email, ruolo = " . $slc_id_role . "
                  WHERE id = " . $get_id;

        // CONTROLLO SE L'UTENTE MODIFICATO SONO IO
        $check_user = "SELECT id FROM utenti WHERE nick = '" . $_SESSION['session_user'] . "'";
        $check = $pdo->query($check_user);
        $fetch = $check->fetch();
        if($fetch['id'] == $get_id){ $_SESSION['session_user'] = $nick; }
    } else if($_SESSION['session_role'] == 2){
        $query = "UPDATE utenti
                  SET nc = :nc, nick = :nick, email = :email
                  WHERE nick = '" . $_SESSION['session_user'] . "'";
        $_SESSION['session_user'] = $nick;
    }
    $check_nick_exist = "SELECT id, nick FROM utenti WHERE nick = '" . $nick . "'";
    $check_res = $pdo->query($check_nick_exist);
    $check_fetch = $check_res->fetch();
    if(count($check_fetch) > 0 && $get_id != $check_fetch['id']){
      header($header . '&errormsg=nickesist');
    } else {
      $pre = $pdo->prepare($query);
      $pre->bindParam(':nc', $nc, PDO::PARAM_STR);
      $pre->bindParam(':nick', $nick, PDO::PARAM_STR);
      $pre->bindParam(':email', $email, PDO::PARAM_STR);

      if((empty($nc) || $nc == 'undefined') || (empty($nick) || $nick == 'undefined') || (empty($email) || $email == 'undefined')){
        header($header . "&errormsg=riempireicampi");
      }
    }

    break;
}
$pre->execute();
//$_SESSION['session_role'] = $slc_id_role;
header($header);
 ?>
