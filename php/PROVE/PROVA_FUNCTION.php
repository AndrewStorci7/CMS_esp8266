<?php
// FILE INUTILIZZATO
// HO PROVATO A CREARE UNA FUNZIONE CHE RICHIAMO PER SCORRERE IL RISULTATO DELLA QUERY

function arrayBidimensionale($param, $pdo){
  $Matrice = $config = ['#', 'Temp', 'n_disp', 'nick', 'data_time'];
  $query_eseg = $pdo->prepare($param);
  $query_eseg->execute();

  if($query_eseg){
    return 0;
  } else {
    $index = 0;
    while($fetch_query = $query_eseg->fetch(PDO::FETCH_ASSOC)) {
      $Matrice = ['#' => strval($index++)];
      $Matrice = ['Temp' => strval($fetch_query['temp'])];
      $Matrice = ['n-disp' => strval($fetch_query['n_disp'])];
      $Matrice = ['nick' => strval($fetch_query['nick'])];
      $Matrice = ['data_time' => strval($fetch_query['data_time'])];
    }
  }
  return $Matrice;
}


$risultato_fun = arrayBidimensionale($query, $pdo);
$num_max = count($risultato_fun);
$num_max_y = count($risultato_fun, COUNT_RECURSIVE);
for($i = 0; $i < $num_max; $i++){
  print_r($risultato_fun[$i]);
  for($y = 0; $y < $num_max_y; $y++){
    print_r($risultato_fun[$y]);
  }
}

 ?>
