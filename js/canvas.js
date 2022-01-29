getData();
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
const ctx = document.getElementById('myChart');

const ore = [];
const temperature = [];


const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ore, // inserire le date
        datasets: [{
            label: 'Temperature registrate nell\'ultimo periodo',
            data: temperature, // inserire i dati delle temperature
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
                beginAtZero: false
            }
        }
    }
});

async function getData(){
    const req = await fetch('../php/API/data.json');
    const resp = await req.text();

    const table = resp.split('\n').slice(1);
    table.forEach(row => {
        const col = row.split(',');
        const hour = col[0];
        ore.push(hour);
        const temp = col[1];
        temperature.push(temp);

        console.log(temp, ore);
    })
}
