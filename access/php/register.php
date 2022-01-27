<?php
require_once('../../php/config.php');

$error1 = '';
$error2 = '';
$error3 = '';
$error4 = '';
$error5 = '';
$error6 = '';

if (isset($_POST['register'])) {
    $nc = $_POST['nomecompleto'] ?? '';
    $nick = $_POST['nick'] ?? '';
    $password = $_POST['pw'] ?? '';
    $isNickValid = filter_var(
        $nick,
        FILTER_VALIDATE_REGEXP, [
            "options" => [
                "regexp" => "/^[a-z\d_]{3,20}$/i"
            ]
        ]
    );
    /*$isNcValid = filter_var(
        $nc,
        FILTER_VALIDATE_REGEXP, [
            "options" => [
                "regexp" => "/^[a-z\d_]$/i"
            ]
        ]
    );*/
    $pwdLenght = mb_strlen($password);

    if (empty($nick)) {
        $error1 = '<p class="error">Inserire il nickname</p>';
        header('Location: ../html/register_form.php');
    } elseif(empty($password)) {
        $error2 = '<p class="error">Inserire la password</p>';
        header('Location: ../html/register_form.php');
    } elseif (false === $isNickValid) {
        $error3 = '<p class="error">L\'username non è valido</p>';
        header('Location: ../html/register_form.php');
    } elseif ($pwdLenght < 8 || $pwdLenght > 20) {
        $error4 = '<p class="error">La password deve essere di almeno 8 caratteri</p>';
        header('Location: ../html/register_form.php');
    } else {
        $password_hash = md5(md5($password));

        $query = "
            SELECT id
            FROM utenti
            WHERE nick = :nick
        ";

        $check = $pdo->prepare($query);
        $check->bindParam(':nick', $nick, PDO::PARAM_STR);
        $check->execute();

        $user = $check->fetchAll(PDO::FETCH_ASSOC);

        if (count($user) > 0) {
            $error5 = '<p class="error">Nickname già in uso</p>';
            header('Location: ../html/register_form.php');
        } else {
            $query = "
                INSERT INTO utenti(nick, pw, nc)
                VALUES (:nick, :pw, :nomecompleto)
            ";

            $check = $pdo->prepare($query);
            $check->bindParam(':nick', $nick, PDO::PARAM_STR);
            $check->bindParam(':pw', $password_hash, PDO::PARAM_STR);
            $check->bindParam(':nomecompleto', $nc, PDO::PARAM_STR);
            $check->execute();

            if ($check->rowCount() > 0) {
                header('Location: ../html/login_form.php');
            } else {
                $error6 = '<p class="error">Problemi con l\'inserimento dei dati</p>';
                header('Location: ../html/register_form.php');
            }
        }
    }
}

?>
