var ctx = document.getElementById('reservas_por_mes').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
    data: reservasPorMesData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});