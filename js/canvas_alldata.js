const ore = [];
const temperature = [];
var data_ora = new Date();
getData();
getChart();

async function getChart(){
  await getData();
  const ctx = document.getElementById('myChartAllData');
  const myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ore,
          datasets: [{
              label: 'ciao', //array conteneti i nomi delle persone o dei dispositivi
              data: temperature,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)'
                ],
              borderColor: [
                  'rgba(255, 99, 132, 1)'
              ],
              borderWidth: 1,
          },
          {
              label: 'ciao', //array conteneti i nomi delle persone o dei dispositivi
              data: temperature,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)'
              ],
              borderWidth: 1,
          }
        ]
      },
      options: {
        scales: {
              y: {
                min: -50,
                max: 50,
              }
            }
      }
  });
}

async function getData(){
    const req = await fetch('../php/API/selectAllData.php');
    const resp = await req.text();
    JSON.stringify(resp);
    const table = JSON.parse(resp);
    const tabella = new Array(table);
    //console.log(tabella);
    // da finire, forse da cambiare proprio logica,
    // cercare di utilizzare i dataset
    for(var i = 0; i < tabella.length; i++){
        var id_d = [];
        id_d = tabella[i];
        console.log(id_d);
        for(var y = 0; y < id_d.length; y++){
          console.log("sono entrato");
        }

    }
}
