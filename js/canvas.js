// VANNO USATI OBBLIGATORIAMENTE PER POTER UTILIZZARE chart.js
// MODIFICARE IL NOME DELL'ID NEL CASO DI UN'ALTRO CANVAS
var ctx = document.getElementById('myChart');
var ctx = document.getElementById('myChart').getContext('2d');
var ctx = $('#myChart');
var ctx = 'myChart';

$.ajax({
  // definisco il tipo della chiamata
  type: "GET",
  // specifico la URL della risorsa da contattare
  url: "../php/API/api.php",
  // passo dei dati alla risorsa remota
  data: "temp=" + temp + "&id_d=" + id_d,
  // definisco il formato della risposta
  dataType: "html",
  // imposto un'azione per il caso di successo
  success: function(risposta){
    $("div#risposta").html(risposta);
  },
  // ed una per il caso di fallimento
  error: function(){
    alert("Chiamata fallita!!!");
  }
}

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: , // inserire le date
        datasets: [{
            label: 'line',
            data: , // inserire i dati delle temperature
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
