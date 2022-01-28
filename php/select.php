<?php
require_once('config.php');

if(isset($_GET['pagina'])){//controllo se esiste un numero di pagina
    $pagina=$_GET['pagina'];//in caso non esista la pagina viene settata a 1
}else{
    $pagina=1;
}

$nometabella='dati';
$condizione='';
$nomecercato='';
$cognomecercato='';

/*if(isset($_POST['nome'])){
    $nomecercato=$_POST['nome'];
}
if(isset($_POST['cognome'])){
    $cognomecercato=$_POST['cognome'];
}
if($cognomecercato!=''){
    if($nomecercato!=''){
        $condizione.='AND';
    }else{
        $condizione.='WHERE';
    }
    $condizione= ' Cognome="'.$cognomecercato.'"';
}
if($nomecercato!=''){
    $condizione= 'WHERE Nome="'. $nomecercato . '"';
}*/


$elementi_da_stampare = 10;
$query = 'SELECT dati.temp, dispositivi.n_disp, utenti.nick, dati.data_time
            FROM dati
            JOIN dispositivi
            JOIN utenti
            ON dati.id_d = dispositivi.id_disp AND dispositivi.id_u = utenti.id ORDER BY dati.id DESC LIMIT ' . ($pagina-1) * $elementi_da_stampare . ',' . $elementi_da_stampare . ';';
$conta_elementi = 'SELECT COUNT(*) AS num_dati FROM dati';

$num_elementi = $pdo->prepare($conta_elementi);
$num_elementi->execute();
$riga = $num_elementi->fetch(PDO::FETCH_ASSOC);
$num_pagine = $riga['num_dati'] / $elementi_da_stampare;

$res = $pdo->prepare($query);
$res->execute();

/*
$num_elementi = $pdo->query($conta_elementi);
$riga = $num_elementi->fetch_assoc();
$num_pagine = $riga['num_dati'] / $elementi_da_stampare;
$risultato = $pdo->query($query);
*/

$index = 0;
if($res->rowCount() > 0){
    echo "
    <div class='container' style='width: 400 !important; height: 400 !important;'><canvas id='myChart'></canvas></div>
    <script src='../js/canvas.js' type='text/javascript'></script>";
    echo '<div>
            <table>
              <tr>
                <th>#</th>
                <th>Temperatura</th>
                <th>Nome disp</th>
                <th>Nickname User</th>
                <th>Data e ora</th>
              </tr>';

    while($risultato = $res->fetch(PDO::FETCH_ASSOC)) {
        $index++;
        $temp = $risultato['temp'];
        $n_disp = $risultato['n_disp'];
        $nick = $risultato['nick'];
        $data_time = $risultato['data_time'];

        echo '<tr>
        <td>' . $index . '</td>
        <td>' . $temp . '</td>
        <td>' . $n_disp . '</td>
        <td>' . $nick . '</td>
        <td>' . $data_time . '</td>
        </tr>';
    }
echo '</table></div></div>';
echo '<div class="pagine">';

    if($num_pagine > $pagina){
        echo '<br><p><center> <a class="piu" href="?pagina='. ($pagina+1) . '">Pagina successiva '.($pagina+1).'>> </a> </center></p>';
    }

    if($pagina > 1){
       echo '<br><p><center><a class="meno" href="?pagina='. ($pagina-1) . '"> << '.($pagina-1).' Pagina precedente </a></center></p>';
    }
}
echo '</div>';
?>
