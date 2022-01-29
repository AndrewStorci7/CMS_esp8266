
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

const ore = new Array();
const temperature = new Array();

getData();
getChart();

async function getChart(){
  //await getData();
  const ctx = document.getElementById('myChart');
  const myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ore,//[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11,12,13,14,15,16,17,18,19,20,21,22,23,24], inserire le date
          datasets: [{
              label: 'Temperature registrate nell\'ultimo periodo',
              data: temperature, // inserire i dati delle temperature
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
                borderWidth: 1
          }]
      }
  });
}

async function getData(){
    const req = await fetch('../php/API/selectData.php');
    const resp = await req.text();

    console.log(resp);
    const table = resp.split('\n').slice(2);
    table.forEach(row => {
        const col = row.split(',');
        const hour = col['temp'][1];
        //const hour = col[1];
        ore.push(Date.parse(hour).toString());
        const temp = col['data_time'][0];
        //const temp = col[0];
        temperature.push(temp);

        console.log('s');
        console.log(temp, hour);
        console.log(temperature, ore);
    });
}
