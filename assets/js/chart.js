const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
        const data = {
            labels: labels,
            datasets: [
                {
                    label: 'Suhu',
                    data: [22, 19, 21, 23, 24, 25, 26],
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1
                },
                {
                    label: 'Amonia',
                    data: [0.1, 0.2, 0.1, 0.2, 0.3, 0.1, 0.2],
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 1
                },
                {
                    label: 'TDS',
                    data: [300, 290, 310, 320, 315, 305, 300],
                    backgroundColor: 'rgba(255, 159, 64, 0.5)',
                    borderColor: 'rgb(255, 159, 64)',
                    borderWidth: 1
                },
                {
                    label: 'pH',
                    data: [7, 7.2, 6.9, 7.1, 7, 7.2, 7.1],
                    backgroundColor: 'rgba(153, 102, 255, 0.5)',
                    borderColor: 'rgb(153, 102, 255)',
                    borderWidth: 1
                }
            ]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, config);