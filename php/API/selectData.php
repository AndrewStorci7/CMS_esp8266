<?php
require_once('../config.php');

        $select_query = "SELECT temp, data_time FROM dati JOIN dispositivi ON dati.id_d = dispositivi.id_disp";
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
