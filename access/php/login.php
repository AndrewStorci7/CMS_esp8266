<?php
session_start();
require_once('../../php/config.php');

if (isset($_SESSION['session_id'])) {
    header('Location: ../../php/index.php?link=userdata');
    exit;
}

if (isset($_POST['login'])) {
    $nick = $_POST['nick']; //?? '';
    $password = $_POST['pw']; //?? '';

    if (empty($nick)) {
        header('Location: ../html/login_form.php?msg=err1');
    } else if(empty($password)) {
        header('Location: ../html/login_form.php?msg=err2');
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

        if (!$user || password_verify($password, $user['pw']) === false) {
            header('Location: ../html/login_form.php?msg=err3');
        } else {
            session_regenerate_id();
            $_SESSION['session_id'] = session_id();
            $_SESSION['session_user'] = $user['nick'];
            $_SESSION['session_role'] = $user['ruolo'];


            header('Location: ../../php/index.php?link=userdata');
            exit;
        }
    }
}

?>
