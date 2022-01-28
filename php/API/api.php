<?php
$host = "127.0.0.1";
$user_db = "root";
$pw_db = "";
$db_name = "as_proj_esp8266";
$conn = new mysqli($host, $user_db, $pw_db, $db_name);
if($conn->connect_errno) {
    echo "Connessione fallita: " . $conn->connect_errno;
    exit();
}

date_default_timezone_set('Europe/Rome');
$dataTime_invio = date('Y-m-d h:i:s', time());
//echo $dataTime_invio;

$temperatura = isset($_GET['temp']) ? $_GET['temp'] : '';
$id_d = isset($_GET['id_d']) ? $_GET['id_d'] : '';

//echo "<br>" . $temperatura . " " . $id_d;
$id_d_cast = intval($id_d);
$temp_cast = floatval($temperatura);
//echo "<br>" . $temp_cast . " " . $id_d_cast;

$insert_query = "INSERT INTO dati(temp, id_d, data_time) VALUES($temp_cast, $id_d_cast, '$dataTime_invio')";
//echo "<br>" . $insert_query;

if(($temperatura == null || $temperatura == 'undefined' || $temperatura == "") || ($id_d == null || $id_d == 'undefined' || $id_d == "")){
    echo "<br>Campi vuoti";
} else {
    if($id_d_cast !== 0 || ($temp_cast == 0 && ($_GET['temp'] !== '0' || $_GET['temp'] !== '0.0'))){
        $result = $conn->query($insert_query);
        if($result->num_rows > 0 && $result !== false){
            echo "<br>Query eseguita<br>";
        } else {
            echo "<br>Query non eseguita <br>";
        }
        //echo $insert_query;
        //echo "<br>" . $result;
    }
}


?>
