<?php
require_once('config.php');
$query = "SELECT * FROM files
          ORDER BY id DESC LIMIT 1";
$result = $pdo->query($query);
if(!$result)
  echo "La query è sbagliata";

while($row = $result->fetch()){
    $addres = $row['nome_foto'];
}
echo $addres;
 ?>
