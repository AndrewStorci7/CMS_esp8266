<?php
session_start();
require_once('../config.php');
if(isset($_SESSION['session_id'])){
    if(isset($_GET['pagina'])) {
        $pagina=$_GET['pagina'];
    } else {
        $pagina=1;
    }

    $data_search = isset($_POST['inputsearch']) ? $_POST['inputsearch'] : '';
    $data_search_parse = floatval($data_search);
    /*if($data_search != null || $data_search != '')
      $cond = ' WHERE temp = ' . $data_search_parse;
    else
      $cond = '';

    if($cognomecercato!=''){
        if($nomecercato!=''){
            $condizione.='AND';
        }else{
            $condizione.='WHERE';
        }
        $condizione= ' Cognome="'.$cognomecercato.'"';
    }*/


    $link = isset($_GET['link']) ? $_GET['link'] : 'userdata';
    $link_cast = strval($link);

    $elementi_da_stampare = 20;
    switch($link){
      case "userdata":
      /*
        USER LOGGED IN DATA
      */
        if($data_search!=''){
          $condizione = ' AND dati.temp = '. $data_search_parse;
        }
        $query = 'SELECT dati.temp, dispositivi.n_disp, utenti.nick, dati.data_time
                  FROM dati
                  JOIN dispositivi
                  JOIN utenti
                  ON dati.id_d = dispositivi.id_disp AND dispositivi.id_u = utenti.id WHERE utenti.nick="' . $_SESSION['session_user'] . $condizione . '" ORDER BY dati.data_time DESC LIMIT ' . ($pagina-1) * $elementi_da_stampare . ',' . $elementi_da_stampare . ';';
        $conta_elementi = 'SELECT COUNT(*) AS num_dati
                           FROM dati JOIN dispositivi JOIN utenti
                           ON dati.id_d = dispositivi.id_disp AND utenti.id = dispositivi.id_u
                           WHERE utenti.nick = "' . $_SESSION['session_user'] . '"';
        $id_chart = "myChart";
        $script = '<script src="../../js/canvas.js?ts=<?=time()?>&quot" type="text/javascript"></script>';
        $link_href = "?link=userdata&pagina=";
        break;
      case "alluserdata":
      /*
        ALL USER DATA
      */
        if($data_search!=''){
          $condizione = ' WHERE dati.temp = '. $data_search_parse;
        }
        $query = 'SELECT dati.temp, dispositivi.n_disp, utenti.nick, dati.data_time
                  FROM dati
                  JOIN dispositivi
                  JOIN utenti
                  ON dati.id_d = dispositivi.id_disp AND dispositivi.id_u = utenti.id ' . $condizione . ' ORDER BY dati.id_d DESC LIMIT ' . ($pagina-1) * $elementi_da_stampare . ',' . $elementi_da_stampare . ';';
        $conta_elementi = 'SELECT COUNT(*) AS num_dati FROM dati';
        $id_chart = "myChartAllData";
        $script = '<script src="../../js/canvas_alldata.js" type="text/javascript"></script>';
        $link_href = "?link=alluserdata&pagina=";
        break;
    }

    $num_elementi = $pdo->prepare($conta_elementi);
    $num_elementi->execute();
    $riga = $num_elementi->fetch(PDO::FETCH_ASSOC);
    $num_pagine = $riga['num_dati'] / $elementi_da_stampare;

    $res = $pdo->prepare($query);
    //$check = $res->bindParam('');
    $res->execute();

    $i = 0;
    $array = array();
    while($fetch = $res->fetch(PDO::FETCH_ASSOC)){
      $array[$i] = array(
        "id" => $i,
        "temp" => $fetch['temp'],
        "n_disp" => $fetch['n_disp'],
        "nick" => $fetch['nick'],
        "data_time" => $fetch['data_time']
      );

      $i++;
    }

    $json = json_encode($array);
    header('Content-Type: application/json');
    echo $json;
    //echo /*'</center><br></div>' . */$script;
} else {
    header('Location: ../../access/html/login_form.php');
}
?>
