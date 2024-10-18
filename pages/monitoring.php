<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <link rel="manifest" href="manifest.json" />

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="assets/lib/animate/animate.min.css" rel="stylesheet">
  <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
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
                <img
                  src="assets/img/icons/keruh.png"
                  alt="Credit Card"
                  class="rounded" />
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
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/lib/wow/wow.min.js"></script>
  <script src="assets/lib/easing/easing.min.js"></script>
  <script src="assets/lib/waypoints/waypoints.min.js"></script>
  <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="assets/lib/counterup/counterup.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="assets/js/chart.js"></script>
  <script src="assets/js/main.js"></script>

  <script>
    $(document).ready(function() {
      function fetchData() {
        $.ajax({
          url: 'api/get_data.php', // Pastikan ini adalah URL yang tepat
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            if (data) {
              $('#suhu').text(data.suhu + ' °C'); // Menampilkan suhu
              $('#amonia').text(data.amonia + ' ppm'); // Menampilkan amonia
              $('#tds').text(data.tds + ' NTU'); // Menampilkan TDS
              $('#ph').text(data.ph); // Menampilkan pH
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log('Error fetching data: ' + textStatus);
          }
        });
      }

      // Memanggil fungsi fetchData setiap 5 detik
      setInterval(fetchData, 100);
    });
  </script>


  <script>
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register("assets/serviceworker.js");
    }
  </script>

  <!-- {{-- Panggil file jquery untuk proses reatime --}} -->
  <script type="text/javascript" src="assets/jquery/jquery.min.js"></script>
  
</body>