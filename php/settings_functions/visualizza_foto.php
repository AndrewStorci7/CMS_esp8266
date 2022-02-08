<?php
//session_start();
require_once('config.php');
  $query = "SELECT files.nome_foto
            FROM files
            JOIN utenti ON files.id = utenti.foto
            WHERE utenti.nick = '" . $_SESSION['session_user'] . "'";
  $result = $pdo->query($query);
  if(!$result)
    echo "La query è sbagliata";

  while($row = $result->fetch(PDO::FETCH_ASSOC)){
      $addres = $row['nome_foto'];
  }


  //header('Location: ../index.php');
 ?>
