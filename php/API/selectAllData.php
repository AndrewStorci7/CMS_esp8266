<?php
session_start();
require_once('../config.php');

if(isset($_SESSION['session_id'])){
      $select_query = "SELECT id_d, temp, data_time
                       FROM dati JOIN dispositivi
                       ON dati.id_d = dispositivi.id_disp
                       ORDER BY dati.id_d DESC";

      $result2 = $pdo->query($select_query);
      $array = array();
      $index = 0;
      while($matrice = $result2->fetch()){
        if($matrice !== null){
          $json = json_encode($matrice);
          echo $json;
        }
        /*for($i = 0; $i < count($matrice); $i++){
          echo $index . '<br>';
        }
        $index++;*/
      }
} else {
  echo "Non sei loggato";
}


?>
