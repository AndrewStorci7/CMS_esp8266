<?php
require_once("../config.php");

if(isset($_GET['id_disp'])){
    $ID = intval($_GET['id_disp']);
}else{
    $ID = 0;
}

if($ID == 0){
    echo 0;
} else {
    $delete = "DELETE FROM dispositivi WHERE id_disp = " . $ID;
    $resultdelete = $pdo->query($delete);
    echo 1;
}
 ?>
