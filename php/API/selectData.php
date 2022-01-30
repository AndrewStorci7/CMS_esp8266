<?php
require_once('../config.php');
$nick_sessione = $_SESSION['session_user'];
echo $nick_sessione;
$select_idutente = "SELECT utenti.id
                    FROM utenti
                    WHERE utenti.nick = '" . $_SESSION['session_user'] . "'";

$select_nick_query = "SELECT dispositivi.id_disp
                      FROM dispositivi JOIN utenti ON dispositivi.id_u = utenti.id
                      WHERE dispositivi.id_u = " . $select_idutente;

$select_query = "SELECT temp, data_time
                 FROM dati JOIN dispositivi ON dati.id_d = dispositivi.id_disp
                 WHERE dati.id_d = " . $select_nick_query;

$result2 = $pdo->prepare($select_query);
$result2->execute();
while($matrice = $result2->fetchAll(PDO::FETCH_DEFAULT)){
  if($matrice !== null){
    $json = json_encode($matrice);
    echo $json;
    //$file = file_put_contents("data.json", $json);
  }
}



?>
