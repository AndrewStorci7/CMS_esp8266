<?php
require_once('../config.php');

date_default_timezone_set('Europe/Rome');
$dataTime_invio = date('d-m-Y H:i:s', time());

$temperatura = isset($_GET['temp']) ? $_GET['temp'] : '';
$id_d = isset($_GET['id_d']) ? $_GET['id_d'] : '';
$temp_cast = floatval($temperatura);

$insert_query = "
  INSERT INTO dati(temp, id_d, data_time)
  VALUES('$temp_cast', :id_d, '$dataTime_invio');
  ";

if(($temperatura == null || $temperatura == 'undefined' || $temperatura == "") || ($id_d == null || $id_d == 'undefined' || $id_d == "")){
    echo "<br>Campi vuoti";
} else {
    if(($temperatura != "0" && $temp_cast == 0) || ($temperatura != "0.0" && $temp_cast == 0)){
      echo "è stata manomessa la query string";
    } else {
      $result = $pdo->prepare($insert_query);
      $result->bindParam(':id_d', $id_d, PDO::PARAM_INT);
      $result->execute();
      $risultato = $result->fetchAll();
    }
}


?>
