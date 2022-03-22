
     <div class='row' style='width: 90% !important; height: auto !important;'>
       <center>
         <canvas id="myChart"></canvas>
       </center>
     </div>
     <script src="../js/canvas.js?ts=<?=time()?>&quot" type="text/javascript"></script>
     <center><p id="msg_ajax" style="font-size: 23px;"></p></center>
     <table id="table-ajax">

     </table>
     <script type="text/javascript">
       $('#btn-search').click(function(){
         var data_search = $('#input-search').val();
         $.post('API/selectData.php', {inputsearch: data_search}, funzioneResp, 'json');
       });
       function funzioneResp(resp){
         if(resp.length > 0){
           document.getElementById("table-ajax").innerHTML = '<tr><th>#</th><th>Temperatura</th><th>Nome Disp</th><th>Nick</th><th>Data Time</th></tr>';
           document.getElementById("msg_ajax").innerHTML = "";
           for(let i = 0; i < resp.length; i++){
             document.getElementById("table-ajax").innerHTML += '<tr><td>' + resp[i].id + '</td><td>' + resp[i].temp + '</td><td>' + resp[i].n_disp + '</td><td>' + resp[i].nick + '</td><td>' + resp[i].data_time + '</td></tr>';
           }
           //document.getElementsById('className').innerHTML = 
         } else {
           document.getElementById("table-ajax").innerHTML = "";
           document.getElementById("msg_ajax").innerHTML = "Nessun dato trovato";
         }
       }
       /*function(resp){
         document.getElementById('table-ajax').innerHTML = "<tr><th>#</th><th>Temp</th><th>N_disp</th><th>Nick</th><th>Data Time</th></tr>";
         for(let i = 0; i < resp.length; i++){
           if(resp.length > 0){
             document.getElementById('table-ajax').innerHTML += '<tr><td>' + resp[i].id + '</td><td>' + resp[i].temp + '</td><td>' + resp[i].n_disp + '</td><td>' + resp[i].nick + '</td><td>' + resp[i].data_time + '</td></tr>';
           } else {
             $('#msg_ajax').text('Nessun dato trovato');
           }
         }
       }*/
     </script>
