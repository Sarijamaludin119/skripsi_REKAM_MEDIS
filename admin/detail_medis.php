<?php
session_start();
if ($_SESSION['password'] == '') {
  header("location: login.php");
}
include '../config/koneksi.php';
error_reporting(0);
?>
<?php
// Require file 'sidebar.php'
require 'nav.php';
?>
<!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <?php
  $id_brg = ($_GET['id']);
  $ggl = !$id_brg;
  if ($ggl) {
    echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5 mt-5'>";
    echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
    echo "<p><center>Maaf Data Ini Tidak Tersedia</center></p>";
    echo "</div>";
    echo "</div>";
  } else {
    $det = mysqli_query($conn, "select * from tenagamedis where id='$id_brg'") or die(mysql_error());
    while ($d = mysqli_fetch_array($det)) {
      ?>
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Info Detail Tenaga Medis:</h6>
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
                  <td>Nama:</td>
                  <td>
                    <?php echo $d['nama']; ?>
                  </td>
                </tr>
                <tr>
                  <td>Alamat:</td>
                  <td>
                    <?php echo $d['alamat']; ?>
                  </td>
                </tr>
                <tr>
                  <td>Nomor Handphone:</td>
                  <td>
                    <?php echo $d['nomor']; ?>
                  </td>
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
          <a href="tab_medis.php"><button type="button" class="btn btn-info">Kembali Lagi</button></a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Footer -->
<?php
// Require file 'sidebar.php'
require 'footer.php';
?>