<?php
session_start();
require_once('../../php/config.php');

$error1 = '';
$error2 = '';
$error3 = '';

if (isset($_SESSION['session_id'])) {
    header('Location: ../../php/index.php');
    exit;
}

if (isset($_POST['login'])) {
    $nick = $_POST['nick'] ?? '';
    $password = $_POST['pw'] ?? '';

    if (empty($nick)) {
        $error1 = '<p class="error">Inserisci l\'username</p>';
        header('Location: ../html/login_form.php');
    } else if(empty($password)) {
        $error2 = '<p class="error">Inserisci la password</p>';
        header('Location: ../html/login_form.php');
    }else{
        $query = "
            SELECT nick, pw
            FROM utenti
            WHERE nick = :nick
        ";

        $check = $pdo->prepare($query);
        $check->bindParam(':nick', $nick, PDO::PARAM_STR);
        //$check->bindParam(':pw', $pw, PDO::PARAM_STR);
        $check->execute();

        $user = $check->fetch(PDO::FETCH_ASSOC);

        if (!$user || password_verify($password, $user['pw']) === false) {
            $error3 = '<p class="error">Credenziali utente errate</p>';
            header('Location: ../html/login_form.php');
        } else {
            session_regenerate_id();
            $_SESSION['session_id'] = session_id();
            $_SESSION['session_user'] = $user['nick'];

            header('Location: ../../php/index.php');
            exit;
        }
    }
}

?>
