<?php
session_start();
require_once('../config.php');
if(isset($_SESSION['session_id'])){
  $query = "SELECT files.nome_foto
            FROM files
            JOIN utenti ON files.id = utenti.foto
            WHERE utenti.nick = '" . $_SESSION['session_user'] . "'";
  $result = $pdo->query($query);
  if(!$result)
    echo "La query è sbagliata";

  while($row = $result->fetch()){
      $addres = $row['nome_foto'];
      echo $addres;
  }
  header('Location: ../index.php');
} else {
  echo "non puoi accedere qui";
}
 ?>
