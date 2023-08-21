<?php
session_start();
if ($_SESSION['password'] == '') {
  header("location: login.php");
}
include '../config/koneksi.php';
$jumlah_produk = mysqli_query($conn, "SELECT COUNT(*) as id from pasien");
$row = mysqli_fetch_array($jumlah_produk);
$jum = $row['id'];
$jumlah_produk = mysqli_query($conn, "SELECT COUNT(*) as id from tenagamedis");
$row = mysqli_fetch_array($jumlah_produk);
$jum_med = $row['id'];
$jumlah_produk = mysqli_query($conn, "SELECT COUNT(*) as id from obat");
$row = mysqli_fetch_array($jumlah_produk);
$jum_bat = $row['id'];
$jumlah_produk = mysqli_query($conn, "SELECT COUNT(*) as id from rekammedis");
$row = mysqli_fetch_array($jumlah_produk);
$jum_rek = $row['id'];
?>
<?php
// Require file 'sidebar.php'
require 'nav.php';
?>

<!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-xl-1">
    </div>
    <!-- Area Chart -->
    <div class="col-xl-10 col-lg-10">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Laporan PUSKESMAS PERAWATAN HITU:</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <center><img class="mt-2" src="img/hospital.png" alt="Virus" width="100px" height="100px"></center>
          <center>
            <h5 class="mt-5"><strong>Rekam Medis</strong></h5>
          </center>
          <center><b>"Aplikasi Untuk Mengelola Data Kesehatan PUSKESMAS PERAWATAN HITU"</b></center>
        </div>
      </div>
    </div>
  </div>
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Laporan PUSKESMAS PERAWATAN HITU:</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <!-- Content Row -->
      <div class="row mt-4">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Pasien Terdaftar
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php echo $jum . " Pasien"; ?>
                  </div>
                </div>
                <div class="col-auto">
                  <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                    class="bi bi-emoji-neutral" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path
                      d="M4 10.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5zm3-4C7 5.672 6.552 5 6 5s-1 .672-1 1.5S5.448 8 6 8s1-.672 1-1.5zm4 0c0-.828-.448-1.5-1-1.5s-1 .672-1 1.5S9.448 8 10 8s1-.672 1-1.5z" />
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Tenaga Medis</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php echo $jum_med . " Tenaga Medis"; ?>
                  </div>
                </div>
                <div class="col-auto">
                  <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                    class="bi bi-journal-medical" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                      d="M8 4a.5.5 0 0 1 .5.5v.634l.549-.317a.5.5 0 1 1 .5.866L9 6l.549.317a.5.5 0 1 1-.5.866L8.5 6.866V7.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L7 6l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V4.5A.5.5 0 0 1 8 4zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                    <path
                      d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                    <path
                      d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jenis Obat</div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                        <?php echo $jum_bat . " Obat"; ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                    class="bi bi-droplet-half" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                      d="M7.21.8C7.69.295 8 0 8 0c.109.363.234.708.371 1.038.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10a6 6 0 0 1-12 0C2 6.668 5.58 2.517 7.21.8zm.413 1.021A31.25 31.25 0 0 0 5.794 3.99c-.726.95-1.436 2.008-1.96 3.07C3.304 8.133 3 9.138 3 10c0 0 2.5 1.5 5 .5s5-.5 5-.5c0-1.201-.796-2.157-2.181-3.7l-.03-.032C9.75 5.11 8.5 3.72 7.623 1.82z" />
                    <path fill-rule="evenodd"
                      d="M4.553 7.776c.82-1.641 1.717-2.753 2.093-3.13l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448z" />
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Rekam Medis</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php echo $jum_rek . " Rekaman"; ?>
                  </div>
                </div>
                <div class="col-auto">
                  <svg width="4em" height="4em" viewBox="0 0 16 16" class="bi bi-bar-chart-line" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z" />
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Content Row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Footer -->
<?php
// Require file 'sidebar.php'
require 'footer.php';
?>