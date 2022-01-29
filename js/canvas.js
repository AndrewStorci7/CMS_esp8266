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

const ore = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
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
    const req = await fetch('../php/API/api.php');
    const resp = await req.text();

    const table = resp.split('\n').slice(1);
    table.forEach(row => {
        const col = row.split(',');
        const temp = col[1];
        console.log(temp);
    })
}
