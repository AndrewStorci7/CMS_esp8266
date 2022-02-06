<?php
session_start();
require_once('../config.php');
if(isset($_SESSION['session_id'])){
  $query = "INSERT INTO dispositivi (n_disp, id_u)
            VALUES ()";
  //da definire
} else {
  echo "non sei loggato";
}
 ?>
