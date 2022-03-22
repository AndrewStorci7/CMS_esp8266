// VANNO USATI OBBLIGATORIAMENTE PER POTER UTILIZZARE chart.js
// MODIFICARE IL NOME DELL'ID NEL CASO DI UN'ALTRO CANVAS
const ore = [];
const temperature = [];
var data_ora = new Date();
const ctx = document.getElementById('myChart');
getData();
getChart();

async function getChart(){
  await getData();

  const myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ore,
          datasets: [{
              label: 'Temperature registrate nell\'ultimo periodo',
              data: temperature,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                  'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1,
          }]
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
  myChart.update();
}

async function getData(){
    const req = await fetch('../php/API/selectData.php');
    const resp = await req.text();
    JSON.stringify(resp);
    const table = JSON.parse(resp);
    console.log(table);
    //const tabella = table.split('\n').slice(4);
    table.forEach(row => {
        const hour = row['data_time'];
        // il Data.parse lo userò per dividere la data dal orario
        //ore.push(new Date(hour));
        ore.push(hour);
        const temp = row['temp'];
        temperature.push(temp);
        console.log(temp, hour);
    });
    console.log(temperature, ore);
}
