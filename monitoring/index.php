<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="./css/bootstrap.min.css"
      integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
      crossorigin="anonymous" />
      <script type="text/javascript" src="jquery/jquery.min.js"></script>

    <style>
      .jumbotron {
        background-image: url('./img/chicken.png');
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }

      .jumbotron::after {
        content: '';
        display: block;
        position: absolute;
        width: 100%;
        height: 30%;
        bottom: 0;
        background: linear-gradient(
          0deg,
          rgba(1, 1, 3, 1) 8%,
          rgba(255, 255, 255, 0) 50%
        );
      }

      .jumbotron h1 {
        font-size: 4rem;
        color: #fff;
        text-shadow: 1px 1px 3px rgba(1, 1, 3, 0.5);
        line-height: 1.2;
      }

      .jumbotron p {
        max-width: 1000px;
        margin-bottom: 20px; /* Menambahkan sedikit margin bawah untuk keindahan */
      }
    </style>

    <title>Monitoring Suhu</title>
    <script type="text/javascript">
       $(document).ready(function () {
        // Fungsi untuk memuat data terbaru
        function loadData() {
            // Menggunakan AJAX untuk memanggil getData.php
            $.ajax({
                url: 'getData.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // Memeriksa apakah ada kesalahan
                    if (data.error) {
                        console.error(data.error);
                    } else {
                        // Memperbarui nilai suhu dan kelembapan
                        $('#suhu').text(data.suhu);
                        $('#kelembapan').text(data.kelembapan);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error: ' + error);
                }
            });
        }

        // Memuat data setiap detik
        setInterval(loadData, 1000);
        
        // Memanggil loadData saat halaman pertama kali dimuat
        loadData();
    });
    </script>

  </head>
  <body>
    <!----Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand font-weight-bold" href="#" style="font-size: 2rem"
        >Monitoring</a
      >
    </nav>
    <!----Navbar end-->

    <!---Hero section-->
    <div class="jumbotron text-center text-white">
      <h1 class="display-4 font-weight-bold">
        Monitor the Health of Your chicken
      </h1>
      <p class="lead">
        Optimize your poultry farming with our advanced web monitoring system
        for chicken coop temperature. Ensure the well-being of your chickens by
        keeping a close eye on environmental conditions.
      </p>
      <a class="btn btn-primary btn-lg" href="#monitoring" role="button"
        >Learn more</a
      >
    </div>
    <!---Hero section end-->
    
    <!---Card-->
    <div class="container__monitoring text-center mx-auto" id="monitoring" style="width: 50%">
        <div class="row p-4 mt-4 mx-auto">
            <div class="col-md-6">
                <div class="card border-danger">
                    <div class="card-header bg-danger">
                        <h4 class="text-white">Suhu</h4>
                    </div>
                    <div class="card-body">
                        <div class="font-weight-bold" style="font-size: 2rem">
  <span id="suhu">Loading...</span
  ><span style="font-size: 1rem; vertical-align: top">°C</span>
</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-danger">
                    <div class="card-header bg-danger">
                        <h4 class="text-white">Kelembapan</h4>
                    </div>
                    <div class="card-body">
                        <div class="font-weight-bold" style="font-size: 2rem">
  <span id="kelembapan">Loading...</span
  ><span style="font-size: 1rem; vertical-align: top">%</span>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---card end-->

    <!--footer-->
    <footer class="footer bg-dark text-white p-4 text-center mt-5">
      <div class="container">
        <p>&copy; 2023 Your Web Monitoring Site. All rights reserved.</p>
      </div>
    </footer>
    <!--footer end-->
  </body>
</html>
