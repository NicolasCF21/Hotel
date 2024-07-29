var ctx = document.getElementById('pago_por_mes').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: pagosPorMesData,
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