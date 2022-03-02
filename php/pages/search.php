<?php
session_start();
require_once('../config.php');
$data_search = isset($_POST['inputsearch']) ? $_POST['inputsearch'] : '';
$elementi_da_stampare = 20;
$condizione = '';
if(isset($_GET['pagina'])) {
    $pagina=$_GET['pagina'];
} else {
    $pagina=1;
}

/*if($data_search!=''){
  $condizione = 'AND temp = '. $data_search;
  $condizione = floatval($condizione);
}*/
$query = 'SELECT dati.temp, dispositivi.n_disp, utenti.nick, dati.data_time
          FROM dati
          JOIN dispositivi
          JOIN utenti
          ON dati.id_d = dispositivi.id_disp AND dispositivi.id_u = utenti.id WHERE utenti.nick="' . $_SESSION['session_user'] . ' ' . $condizione . '" ORDER BY dati.data_time DESC LIMIT ' . ($pagina-1) * $elementi_da_stampare . ',' . $elementi_da_stampare . ';';
$conta_elementi = 'SELECT COUNT(*) AS num_dati
                   FROM dati JOIN dispositivi JOIN utenti
                   ON dati.id_d = dispositivi.id_disp AND utenti.id = dispositivi.id_u
                   WHERE utenti.nick = "' . $_SESSION['session_user'] . '"';

$num_elementi = $pdo->prepare($conta_elementi);
$num_elementi->execute();
$riga = $num_elementi->fetch(PDO::FETCH_ASSOC);
$num_pagine = $riga['num_dati'] / $elementi_da_stampare;

$res = $pdo->query($query);
//$res = $pdo->prepare($query);
//$check = $res->bindParam('');
//$res->execute();
$i=0;
$array=array();
if($res>0){
	while($fetch = $res->fetch(PDO::FETCH_ASSOC)){
		$temp = $fetch['temp'];
		$n_disp = $fetch['n_disp'];
		$nick = $fetch['nick'];
    $data_time = $fetch['data_time'];

		$array[$i] = array(
				"id" => $i,
				"temp" => $temp,
				"n_disp" => $n_disp,
        "nick" => $nick,
        "data_time" => $data_time
		);
		$i++;
	}
}
$json = json_encode($array);
header('Content-Type: application/json');
echo $json;

 ?>
