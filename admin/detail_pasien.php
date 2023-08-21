<?php
session_start();
if (!isset($_SESSION['password']) || empty($_SESSION['password'])) {
  header("location: login.php");
  exit(); // Added exit to prevent further execution
}
include '../config/koneksi.php';
error_reporting(E_ALL); // Set error reporting to show all errors
?>
<?php
// Require file 'nav.php'
require 'nav.php';
?>
<!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <?php
  if (!isset($_GET['id'])) {
    echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5 mt-5'>";
    echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
    echo "<p><center>Maaf Data Ini Tidak Tersedia</center></p>";
    echo "</div>";
    echo "</div>";
  } else {
    $id_brg = $_GET['id'];
    $det = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$id_brg'") or die(mysqli_error($conn)); // Used mysqli_error($conn)
    while ($d = mysqli_fetch_array($det)) {
  ?>
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Info Detail Pasien:</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <!-- Content Row -->
          <div class="row ml-5">
            <div class="col-md-10 col-sm-12 col-xs-12">
              <h2>
                <center>Info Detail Pasien</center>
              </h2>
              <table class="table">
                <tr>
                  <td>Nama Pasien:</td>
                  <td><?php echo $d['nama']; ?></td>
                </tr>
                <tr>
                  <td>Nik Pasien:</td>
                  <td><?php echo $d['nik']; ?></td>
                </tr>
                <tr>
                  <td>Jenis Kelamin:</td>
                  <td><?php echo $d['kelamin']; ?></td>
                </tr>
                <tr>
                  <td>Alamat:</td>
                  <td><?php echo $d['alamat']; ?></td>
                </tr>
                <tr>
                  <td>Nomor Handphone:</td>
                  <td><?php echo $d['nomor']; ?></td>
                </tr>
              </table>
            </div>
          </div>
      <?php
    }
  }
      ?>
      <div class="row">
        <div class="col-md-9">
        </div>
        <div class="col-md-3">
          <a href="tab_pasien.php"><button type="button" class="btn btn-info">Kembali</button></a>
          <a href="print.php?id=<?php echo $id_brg; ?>" target="_blank"><button type="button" class="btn btn-warning">Print</button></a>
        </div>
      </div>
      <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
        <?php
        // Require file 'footer.php'
        require 'footer.php';
        ?>