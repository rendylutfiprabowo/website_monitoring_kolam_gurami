<div class="container mt-5">
  <div class="row">
    <div class="col">
      <div class="card">
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
      <div class="card">
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
      <div class="card">
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
      <div class="card">
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

  <div class="row mt-5">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <canvas id="myChart"></canvas>
        </div>
      </div>
    </div>
  </div>

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

    // Panggil fungsi untuk load data saat halaman dimuat
    window.onload = loadMonitoringData;
  </script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="assets/js/chart.js"></script>
</div>