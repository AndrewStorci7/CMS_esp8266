<?php
require_once('../../php/config.php');

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

    if (empty($nick) || empty($password)) {
        $msg = 'Compila tutti i campi %s';
    } elseif (false === $isNickValid) {
        $msg = 'Lo username non è valido. Sono ammessi solamente caratteri
                alfanumerici e l\'underscore. Lunghezza minina 3 caratteri.
                Lunghezza massima 20 caratteri';
    } elseif ($pwdLenght < 8 || $pwdLenght > 20) {
        $msg = 'Lunghezza minima password 8 caratteri.
                Lunghezza massima 20 caratteri';
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
            $msg = 'Nickname già in uso %s';
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
                $msg = 'Registrazione eseguita con successo';
            } else {
                $msg = 'Problemi con l\'inserimento dei dati %s';
            }
        }
    }

    printf($msg, '<a href="../html/register.html">torna indietro</a>');
}

?>
