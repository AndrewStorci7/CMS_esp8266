<?php
session_start();
require_once('../../php/config.php');

if (isset($_SESSION['session_id'])) {
    header('Location: ../../php/config.php');
    exit;
}

if (isset($_POST['login'])) {
    $nick = $_POST['nick'] ?? '';
    $password = $_POST['pw'] ?? '';

    if (empty($nick) || empty($password)) {
        $msg = 'Inserisci username e password %s';
    } else {
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
            $msg = 'Credenziali utente errate %s';
        } else {
            session_regenerate_id();
            $_SESSION['session_id'] = session_id();
            $_SESSION['session_user'] = $user['nick'];

            header('Location: ../../php/config.php');
            exit;
        }
    }

    printf($msg, '<a href="../html/login.html">torna indietro</a>');
}

?>
