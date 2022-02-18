<?php
session_start();
require_once('../config.php');

if(isset($_SESSION['session_id']) && (isset($_SESSION['session_role']) && $_SESSION['session_role'] == 1)){
      $select_query = "SELECT id_d, temp, data_time
                       FROM dati JOIN dispositivi
                       ON dati.id_d = dispositivi.id_disp
                       ORDER BY dati.id_d DESC";

      $result2 = $pdo->prepare($select_query);
      $result2->execute();
      //$array = array();
      while($matrice = $result2->fetchAll(PDO::FETCH_GROUP)){
        if($matrice !== null){
          $json = json_encode($matrice);
        }
      }
      echo $json;
} else {
  echo "Non sei loggato o non sei un amministratore";
}


?>
