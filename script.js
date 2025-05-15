document.addEventListener('DOMContentLoaded', function() {
    // Wochenstunden-Diagramm
    const weekChartCtx = document.getElementById('weekChart').getContext('2d');
    new Chart(weekChartCtx, {
        type: 'bar',
        data: {
            labels: ['Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So'],
            datasets: [{
                data: [0, 0, 0, 0, 0, 0, 0],
                backgroundColor: '#E5E5E5',
                borderRadius: 5,
                barThickness: 20
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 8,
                    ticks: {
                        stepSize: 2
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Finanz-Diagramm
    const financeChartCtx = document.getElementById('financeChart').getContext('2d');
    new Chart(financeChartCtx, {
        type: 'line',
        data: {
            labels: ['Mai \'24', 'Jun \'24', 'Jul \'24', 'Aug \'24', 'Sep \'24', 
                     'Okt \'24', 'Nov \'24', 'Dez \'24', 'Jan \'25', 'Feb \'25', 
                     'Mär \'25', 'Apr \'25', 'Mai \'25'],
            datasets: [{
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                borderColor: '#27AE60',
                backgroundColor: 'rgba(39, 174, 96, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '€ ' + value;
                        }
                    }
                }
            }
        }
    });

    // Tab-Funktionalität
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
        });
    });
});