<?php
require_once('../config.php');

date_default_timezone_set('Europe/Rome');
$dataTime_invio = date('Y-m-d H:i:s', time());

$temperatura = isset($_GET['temp']) ? $_GET['temp'] : '';
$id_d = isset($_GET['id_d']) ? $_GET['id_d'] : '';

$insert_query = "INSERT INTO dati(temp, id_d, data_time) VALUES( :temp, :id_d, '$dataTime_invio')";

if(($temperatura == null || $temperatura == 'undefined' || $temperatura == "") || ($id_d == null || $id_d == 'undefined' || $id_d == "")){
    echo "<br>Campi vuoti";
} else {
    $result = $pdo->prepare($insert_query);
    $result->bindParam(':temp', $temperatura);
    $result->bindParam(':id_d', $id_d, PDO::PARAM_INT);
    $result->execute();
    //$matrice = $result->fetchAll(PDO::FETCH_DEFAULT);
    $risultato = $result->fetchAll();
    if($risultato > 0){
        $select_query = "SELECT temp, data_time FROM dati JOIN dispositivi ON dati.id_d = dispositivi.id_disp";
        $result2 = $pdo->prepare($select_query);
        $result2->execute();

        $matrice = $result2->fetch(PDO::FETCH_ASSOC);
        if($matrice > 0){
            $json = json_encode($matrice);
            $file = file_put_contents("data.json", $json);
        } else
            echo 'non c\'è nulla da aggiungere';
    } else {
        echo "<br>Query non eseguita <br>";
    }
}


?>
