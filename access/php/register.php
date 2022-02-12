<?php
require_once('../../php/config.php');

//if (isset($_POST['register'])) {
    //$msg = "";

    $nc = $_POST['nomecompleto'] ?? '';
    $nick = $_POST['nick'] ?? '';
    $password = $_POST['pw'] ?? '';
    $email = $_POST['email'] ?? '';
    $isEmailValid = filter_var(
        $email,
        FILTER_VALIDATE_EMAIL
    );
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

    if(empty($nc)){
        echo 1;
    } else if (empty($nick)) {
        echo 2;
    } else if (empty($email)) {
        echo 3;
    } else if(empty($password)) {
        echo 4;
    } elseif (false === $isNickValid) {
        echo 5;
    } elseif ($pwdLenght < 8 || $pwdLenght > 20) {
        echo 6;
        //Password corta
    } else {
        $password_hash = md5(md5($password));
        //echo $password_hash;

        $query = "
            SELECT id
            FROM utenti
            WHERE email = :email OR nick = :nick";

        $check = $pdo->prepare($query);
        $check->bindParam(':email', $email, PDO::PARAM_STR);
        $check->bindParam(':nick', $nick, PDO::PARAM_STR);
        $check->execute();

        $user = $check->fetchAll(PDO::FETCH_ASSOC);

        if (count($user) > 0) {
            echo 7;
            //Nickname o email già in uso
        } else {
            $query = "
                INSERT INTO utenti(nick, email, pw, nc)
                VALUES (:nick, :email, :pw, :nomecompleto)
            ";

            $check = $pdo->prepare($query);
            $check->bindParam(':email', $email, PDO::PARAM_STR);
            $check->bindParam(':nick', $nick, PDO::PARAM_STR);
            $check->bindParam(':pw', $password_hash, PDO::PARAM_STR);
            $check->bindParam(':nomecompleto', $nc, PDO::PARAM_STR);
            $check->execute();

            if ($check->rowCount() > 0) {
                echo 8;
                //Registrazione avvenuta
            } else {
                echo 9;
                //Registrazione non avvenuta
            }
        }
    }
//}
 ?>
