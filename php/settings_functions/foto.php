<?php
require_once('../config.php');
if(!isset($_FILES['foto']) || !is_uploaded_file($_FILES['foto']['tmp_name'])){
  echo "Errore nell\'upload";
}

$upload_path = '../../img/immagini_utenti/';
$tmp_name = $_FILES['foto']['tmp_name'];
$realname_file = $_FILES['foto']['name'];
$path = $upload_path . $realname_file;
if(move_uploaded_file($tmp_name, $path)){
  $insert = "INSERT INTO files (nome_foto)
             VALUES ('img/immagini_utenti/$realname_file')";
  $res = $pdo->query($insert);
  if(!$res)
    echo "errore nella query";
  else
    header('Location: ../profile.php');

} else {
  echo "Upload non riuscito";
}
 ?>
