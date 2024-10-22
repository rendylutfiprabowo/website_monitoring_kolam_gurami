<style>
  .bg-red {
    background-color: red;
  }
</style>


<div class="container mt-5">
  <div class="row">
    <div class="col">
      <div class="card m-1">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="assets/img/icons/suhu.png" alt="chart success" class="rounded" />
            </div>
          </div>
          <span class="fw-semibold d-block mb-1">Suhu Air</span>
          <h3 id="suhu" class="card-title mb-2">0</h3>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card m-1">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="assets/img/icons/oksigen.png" alt="Credit Card" class="rounded" />
            </div>
          </div>
          <span class="fw-semibold d-block mb-1">Amonia</span>
          <h3 id="amonia" class="card-title mb-2">0</h3>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card m-1">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="assets/img/icons/keruh.png" alt="Credit Card" class="rounded" />
            </div>
          </div>
          <span class="fw-semibold d-block mb-1">Padatan Terlarut</span>
          <h3 id="tds" class="card-title mb-2">0</h3>
        </div>
      </div>
    </div>

    <div class="col">
      <div class="card m-1">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="assets/img/icons/ph.png" alt="Credit Card" class="rounded" />
            </div>
          </div>
          <span class="fw-semibold d-block mb-1">pH Air</span>
          <h3 id="ph" class="card-title text-nowrap mb-2">0</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col">
      <div class="card">
        <div class="card-body">
        <canvas id="chartAllSensors"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <canvas id="chartSuhu"></canvas>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <canvas id="chartAmonia"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <canvas id="chartTDS"></canvas>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-body">
          <canvas id="chartPh"></canvas>
        </div>
      </div>
    </div>
  </div>


<!-- grafik all sensor  -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  function getData() {
    fetch('http://localhost/monitoring/api/get_data_allsensor.php')
      .then(response => response.json())
      .then(data => {
        if (data.error) {
          console.error("Error:", data.error);
          return;
        }

        const labels = data.rata_rata_per_jam.map(item => item.jam + ':00');
        const dataTDS = data.rata_rata_per_jam.map(item => item.rata_rata_tds);
        const dataPH = data.rata_rata_per_jam.map(item => item.rata_rata_ph);
        const dataAmonia = data.rata_rata_per_jam.map(item => item.rata_rata_amonia);
        const dataSuhu = data.rata_rata_per_jam.map(item => item.rata_rata_suhu);

        createChart(labels, dataTDS, dataPH, dataAmonia, dataSuhu);
      })
      .catch(error => console.error("Error fetching data:", error));
  }

  function createChart(labels, dataTDS, dataPH, dataAmonia, dataSuhu) {
    const ctx = document.getElementById('chartAllSensors').getContext('2d');
    if(window.myChart instanceof Chart) {
      window.myChart.destroy();
    }
    window.myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'TDS',
          borderColor: 'rgb(75, 192, 192)',
          fill: false,
          data: dataTDS
        }, {
          label: 'pH',
          borderColor: 'rgb(255, 159, 64)',
          fill: false,
          data: dataPH
        }, {
          label: 'Amonia',
          borderColor: 'rgb(255, 99, 132)',
          fill: false,
          data: dataAmonia
        }, {
          label: 'Suhu',
          borderColor: 'rgb(255, 205, 86)',
          fill: false,
          data: dataSuhu
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
  }

  getData();
  setInterval(getData, 60000); // Refresh data every 60 seconds
});
</script> 



  <!-- grafik suhu -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Fungsi untuk mengambil data dari PHP menggunakan AJAX
      function getData() {
        fetch('http://localhost/monitoring/api/get_data_suhu.php') // Ganti dengan path file PHP Anda
          .then(response => response.json())
          .then(data => {
            if (data.error) {
              console.error("Error:", data.error);
              return;
            }

            // Proses data yang diterima
            const suhu = data.rata_rata_per_jam.map(item => item.rata_rata_suhu);
            const jam = data.rata_rata_per_jam.map(item => item.jam + ':00'); // Tambahkan ':00' untuk menunjukkan jam penuh

            // Panggil fungsi untuk membuat grafik
            createChart(jam, suhu);
          })
          .catch(error => console.error("Error fetching data:", error));
      }

      // Fungsi untuk membuat grafik suhu dinamis
      function createChart(labels, data) {
        let chartData = {
          labels: labels, // Data jam sebagai label
          datasets: [{
            label: 'Rata-Rata Suhu Per Jam',
            data: data, // Data rata-rata suhu
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
          }]
        };

        const config = {
          type: 'line',
          data: chartData,
          options: {
            scales: {
              y: {
                beginAtZero: true // Pastikan skala Y dimulai dari 0
              }
            }
          }
        };

        const chartSuhu = new Chart(document.getElementById('chartSuhu'), config);
      }

      // Panggil fungsi untuk mengambil data saat halaman di-load
      getData();
      setInterval(getData, 1000); // Refresh data setiap 1 detik
      
    });
  </script>

  <!-- grafik amonia -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Fungsi untuk mengambil data dari PHP menggunakan AJAX
      function getData() {
        fetch('http://localhost/monitoring/api/get_data_amonia.php') // Ganti dengan path file PHP Anda
          .then(response => response.json())
          .then(data => {
            if (data.error) {
              console.error("Error:", data.error);
              return;
            }

            // Proses data yang diterima
            const amonia = data.rata_rata_per_jam.map(item => item.rata_rata_amonia);
            const jam = data.rata_rata_per_jam.map(item => item.jam + ':00'); // Tambahkan ':00' untuk menunjukkan jam penuh

            // Panggil fungsi untuk membuat grafik
            createChart(jam, amonia);
          })
          .catch(error => console.error("Error fetching data:", error));
      }

      // Fungsi untuk membuat grafik amonia dinamis
      function createChart(labels, data) {
        let chartData = {
          labels: labels, // Data jam sebagai label
          datasets: [{
            label: 'Rata-Rata Amonia Per Jam',
            data: data, // Data rata-rata amonia
            fill: false,
            borderColor: 'rgb(255, 99, 132)',
            tension: 0.1
          }]
        };

        const config = {
          type: 'line',
          data: chartData,
          options: {
            scales: {
              y: {
                beginAtZero: true // Pastikan skala Y dimulai dari 0
              }
            }
          }
        };

        const chartAmonia = new Chart(document.getElementById('chartAmonia'), config);
      }

      // Panggil fungsi untuk mengambil data saat halaman di-load
      getData();
      setInterval(getData, 1000); // Refresh data setiap 1 detik
    });
  </script>

  <!-- grafik tds -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Fungsi untuk mengambil data dari PHP menggunakan AJAX
      function getData() {
        fetch('http://localhost/monitoring/api/get_data_tds.php') // Ganti dengan path file PHP Anda
          .then(response => response.json())
          .then(data => {
            if (data.error) {
              console.error("Error:", data.error);
              return;
            }

            // Proses data yang diterima
            const tds = data.rata_rata_per_jam.map(item => item.rata_rata_tds);
            const jam = data.rata_rata_per_jam.map(item => item.jam + ':00'); // Tambahkan ':00' untuk menunjukkan jam penuh

            // Panggil fungsi untuk membuat grafik
            createChart(jam, tds);
          })
          .catch(error => console.error("Error fetching data:", error));
      }

      // Fungsi untuk membuat grafik TDS dinamis
      function createChart(labels, data) {
        let chartData = {
          labels: labels, // Data jam sebagai label
          datasets: [{
            label: 'Rata-Rata TDS Per Jam',
            data: data, // Data rata-rata TDS
            fill: false,
            borderColor: 'rgb(75, 192, 192)', // Warna biru muda
            tension: 0.1
          }]
        };

        const config = {
          type: 'line',
          data: chartData,
          options: {
            scales: {
              y: {
                beginAtZero: true // Pastikan skala Y dimulai dari 0
              }
            }
          }
        };

        const chartTDS = new Chart(document.getElementById('chartTDS'), config);
      }

      // Panggil fungsi untuk mengambil data saat halaman di-load
      getData();
      setInterval(getData, 1000); // Refresh data setiap 1 detik
    });
  </script>

  <!-- grafik pH -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Fungsi untuk mengambil data dari PHP menggunakan AJAX
      function getData() {
        fetch('http://localhost/monitoring/api/get_data_ph.php') // Ganti dengan path file PHP Anda
          .then(response => response.json())
          .then(data => {
            if (data.error) {
              console.error("Error:", data.error);
              return;
            }

            // Proses data yang diterima
            const ph = data.rata_rata_per_jam.map(item => item.rata_rata_ph);
            const jam = data.rata_rata_per_jam.map(item => item.jam + ':00'); // Tambahkan ':00' untuk menunjukkan jam penuh

            // Panggil fungsi untuk membuat grafik
            createChart(jam, ph);
          })
          .catch(error => console.error("Error fetching data:", error));
      }

      // Fungsi untuk membuat grafik pH dinamis
      function createChart(labels, data) {
        let chartData = {
          labels: labels, // Data jam sebagai label
          datasets: [{
            label: 'Rata-Rata pH Per Jam',
            data: data, // Data rata-rata pH
            fill: false,
            borderColor: 'rgb(255, 159, 64)', // Warna oranye
            tension: 0.1
          }]
        };

        const config = {
          type: 'line',
          data: chartData,
          options: {
            scales: {
              y: {
                beginAtZero: false // Skala Y tidak dimulai dari 0 untuk pH
              }
            }
          }
        };

        const chartPh = new Chart(document.getElementById('chartPh'), config);
      }

      // Panggil fungsi untuk mengambil data saat halaman di-load
      getData();
      setInterval(getData, 1000); // Refresh data setiap 1 detik
    });
  </script>

  <!-- ambil data untuk menampilkan data realtime -->
  <script>
    // Fungsi untuk mengambil data dari get_data.php
    function loadMonitoringData() {
      fetch('http://localhost/monitoring/api/get_data.php') // Pastikan URL di sini benar
        .then(response => response.json()) // Parsing respons sebagai JSON
        .then(data => {
          console.log(data); // Periksa respons data di konsol

          // Update nilai di elemen HTML sesuai ID
          document.getElementById('suhu').textContent = data.suhu || 'Sensor Error';
          document.getElementById('amonia').textContent = data.amonia || 'Sensor Error';
          document.getElementById('tds').textContent = data.tds || 'Sensor Error';
          document.getElementById('ph').textContent = data.ph || 'Sensor Error';
        })
        .catch(error => {
          console.error('Terjadi kesalahan:', error);
          alert('Gagal memuat data');
        });
    }

    // Set interval untuk memanggil loadMonitoringData setiap 5 detik
    setInterval(loadMonitoringData, 500);


    // Panggil fungsi untuk load data saat halaman dimuat
    window.onload = loadMonitoringData;
  </script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="assets/js/chart.js"></script>
</div>