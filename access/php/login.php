<?php
session_start();
require_once('../../php/config.php');

if (isset($_SESSION['session_id'])) {
    header('Location: ../../php/index.php?link=userdata');
    exit;
}

//if (isset($_POST['login'])) {
    $nick = $_POST['nick'] ?? '';
    $password = $_POST['pw'] ?? '';
    $password_check = md5(md5($password));

    if (empty($nick)) {
        echo 1;
    } else if(empty($password)) {
        echo 2;
    }else{
        $query = "
            SELECT nick, pw, ruolo
            FROM utenti
            WHERE nick = :nick
        ";

        $check = $pdo->prepare($query);
        $check->bindParam(':nick', $nick, PDO::PARAM_STR);
        //$check->bindParam(':pw', $pw, PDO::PARAM_STR);
        $check->execute();

        $user = $check->fetch(PDO::FETCH_ASSOC);

        if (!$user || ($user['pw'] !== $password_check)) {
            echo 3;
        } else {
            session_regenerate_id();
            $_SESSION['session_id'] = session_id();
            $_SESSION['session_user'] = $user['nick'];
            $_SESSION['session_role'] = $user['ruolo'];

            echo 4;
            //header('Location: ../../php/index.php?link=userdata');
            exit;
        }
    }
//}

/*$msg = isset($_GET['msg']) ? $_GET['msg'] : "";
strval($msg);
$errmsg = "";
$classerr = "";
switch ($msg) {
  case 'err3':
    $errmsg = "<p style='color: red; font-size: 12px;'>Credenziali errate</p>";
    $classerr = "is-invalid";
    break;

  case 'err2':
    $errmsg = "<p style='color: red; font-size: 12px;'>Inserire la password</p>";
    $classerr = "is-invalid";
    break;

  case 'err1':
    $errmsg = "<p style='color: red; font-size: 12px;'>Inserire il nickname</p>";
    $classerr = "is-invalid";
    break;
}*/
 ?>
