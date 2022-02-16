<?php
require_once('../config.php');
if(!isset($_FILES['foto']) || !is_uploaded_file($_FILES['foto']['tmp_name'])){
  echo "Errore nell\'upload";
}
$get_id_u = isset($_GET['id_u']) ? $_GET['id_u'] : '';
intval($get_id_u);
if($get_id_u == 0){
  echo "l\'id è 0";
}

$upload_path = '../../img/immagini_utenti/';
$tmp_name = $_FILES['foto']['tmp_name'];
$realname_file = $_FILES['foto']['name'];
$path = $upload_path . $realname_file;
if(move_uploaded_file($tmp_name, $path)){
  $insert = "INSERT INTO files (nome_foto)
             VALUES ('img/immagini_utenti/$realname_file')";
  $res = $pdo->query($insert);

  if(!$res) {
    echo "errore nella query";
  } else {
    $update_foto_user = "(SELECT id FROM files WHERE nome_foto = 'img/immagini_utenti/" . $realname_file . "' ORDER BY id LIMIT 1)";
    $update_foto = "UPDATE utenti
                    SET foto = " . $update_foto_user . "
                    WHERE id = " . $get_id_u . "";
    $update_foto = $pdo->query($update_foto);
    header('Location: ../profile.php');
  }

} else {
  echo "Upload non riuscito";
}
 ?>
