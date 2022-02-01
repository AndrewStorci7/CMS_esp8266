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
              label: , //array conteneti i nomi delle persone o dei dispositivi
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
              label: , //array conteneti i nomi delle persone o dei dispositivi
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

    table.forEach(row => {
        const id = row['id_d'];
        while(id != row){
          var datasets = table.dataset.id_d;
          var temp = row['temp'];
          datasets.dataset.
        }

        const hour = row['data_time'];
        // il Data.parse lo userò per dividere la data dal orario
        //ore.push(new Date(hour));
        ore.push(hour);
        const temp = row['temp'];
        temperature.push(temp);
        console.log(temp, hour);
    });
    //console.log(temperature, ore);
}
