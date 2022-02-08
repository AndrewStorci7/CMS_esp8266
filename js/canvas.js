/*function ajaxApi(){
    const req = new XMLHttpRequest();

    req.open('GET', '../php/API/api.php', true);
    req.send();

    req.onreadystatechange = function(){
      if(this.readyState === 4 && this.status === 200){
          console.log(this.responseText);
      }
    }
}*/


// VANNO USATI OBBLIGATORIAMENTE PER POTER UTILIZZARE chart.js
// MODIFICARE IL NOME DELL'ID NEL CASO DI UN'ALTRO CANVAS
const ore = [];
const temperature = [];
var data_ora = new Date();
getData();
getChart();

async function getChart(){
  await getData();
  const ctx = document.getElementById('myChart');
  const myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ore,
          datasets: [{
              label: 'Temperature registrate nell\'ultimo periodo',
              data: temperature,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)'
                  /*'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'*/
                ],
                //fill: false,
                borderColor: [
                  'rgba(255, 99, 132, 1)'
                  /*'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'*/
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
      /*options: {
        animation,
        interaction: {
            intersect: false
        },
        plugins: {
            legend: false,
            title: {
                display: true,
                text: () => easing.name
            }
        },
        scale : {
          x: {
            type: 'time',
            time: {
              // Luxon format string
              tooltipFormat: 'DD T'
            },
            title: {
              display: true,
              text: 'Date'
            }
          },
          y: {
            title: {
              display: true,
              text: 'value'
            }
          }
        }
      }*/
  });
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
