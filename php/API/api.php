<?php
require_once('../config.php');

date_default_timezone_set('Europe/Rome');
$dataTime_invio = date('Y-m-d h:i:s', time());
//echo $dataTime_invio;

$temperatura = isset($_GET['temp']) ? $_GET['temp'] : '';
$id_d = isset($_GET['id_d']) ? $_GET['id_d'] : '';

//echo "<br>" . $temperatura . " " . $id_d;
//$id_d_cast = intval($id_d);
//$temp_cast = floatval($temperatura);
//echo "<br>" . $temp_cast . " " . $id_d_cast;

$insert_query = "INSERT INTO dati(temp, id_d, data_time) VALUES( :temp, :id_d, '$dataTime_invio')";
//echo "<br>" . $insert_query;

if(($temperatura == null || $temperatura == 'undefined' || $temperatura == "") || ($id_d == null || $id_d == 'undefined' || $id_d == "")){
    echo "<br>Campi vuoti";
} else {
    $result = $pdo->prepare($insert_query);
    $result->bindParam(':temp', $temperatura, PDO::PARAM_STR);
    $result->bindParam(':id_d', $id_d, PDO::PARAM_INT);
    $result->execute();
    //$matrice = $result->fetchAll(PDO::FETCH_DEFAULT);
    $matrice = $result->fetchAll();
    if($matrice > 0){
        $json = json_encode($matrice);
        $file = file_put_contents("data.json", $json);
        //echo $file;
    } else {
        echo "<br>Query non eseguita <br>";
    }
}


?>
