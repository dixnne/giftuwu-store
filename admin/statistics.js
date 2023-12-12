function createChart1($data0, $data1, $data2, $data3, $data4, $data5, $data6) {
    const ctx = document.getElementById('chart1');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Comestibles', 'Vestimenta', 'Objetos', 'Videojuegos', 'Envolturas', 'Giftcards'],
            datasets: [{
            label: 'Artículos por categoría',
            data: [$data0, $data1, $data2, $data3, $data4, $data5, $data6],
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
}

function createChart2($data0, $data1, $data2, $data3, $data4, $data5, $data6) {
    const ctx = document.getElementById('chart2');
    new Chart(ctx, {
        type: 'polarArea',
        data: {
            labels: ['Comestibles', 'Vestimenta', 'Objetos', 'Videojuegos', 'Envolturas', 'Giftcards'],
            datasets: [{
            label: 'Promedio en precios por categoría',
            data: [$data0, $data1, $data2, $data3, $data4, $data5, $data6],
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
}