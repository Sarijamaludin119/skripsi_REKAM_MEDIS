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
  $id_pesan = ($_GET['pesan']);
  $ggl = !$id_brg;
  $dgi = !$id_pesan;
  if ($ggl and $dgi) {
    echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5 mt-5'>";
    echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
    echo "<p><center>Maaf Data Ini Tidak Tersedia</center></p>";
    echo "</div>";
    echo "</div>";
  } else {
    $sg = mysqli_query($conn, "select * from admin where id='$id_brg'");
    while ($sw = mysqli_fetch_array($sg)) {
      ?>
      <div class="card shadow  ml-4 mr-4">
        <div class="card-header py-3">
          <h1 class="h3 mb-0 text-gray-800">Ubah Password</h1>
        </div>
        <form action="change_pass.php" method="post">
          <div class="row ml-5 mb-2 mt-3">
            <div class="col-md-6">
              <input class="form-control" type="hidden" name='username' value="<?php echo $sw['username']; ?>" required>
              <P><b>Password Lama</b></p>
              <input class="form-control" type="password" name='pertama' placeholder="Password Lama..." required>
              <P><b>Password Baru</b></p>
              <input class="form-control" type="password" name='kedua' value="" placeholder="Password Baru..." required>
              <P><b>Ulangi Password Baru</b></p>
              <input class="form-control" type="password" name='ketiga' value="" placeholder="Password Baru..." required>
            </div>
          </div>
          <div class="row ml-5 mb-4 mt-3">
            <div class="col-md-5">
              <button type="submit" class="btn btn-info" name='edit'>Update</button>&nbsp;<input type="reset"
                class="btn btn-danger" value="Reset">
            </div>
          </div>
        </form>
      </div>
    <?php }
  } ?>
  <?php
  if (isset($_GET['pesan'])) {
    $pesan = addslashes($_GET['pesan']);
    if ($pesan == "gagal") {
      echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
      echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
      echo "<p><center>Gagal Mengganti Password</center></p>";
      echo "</div>";
      echo "</div>";
    } else if ($pesan == "tdksama") {
      echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
      echo "<div class='alert alert-warning mt-4 ml-5' role='alert'>";
      echo "<p><center>Password Yang Anda Masukan Tidak Sama</center></p>";
      echo "</div>";
      echo "</div>";
    } else if ($pesan == "oke") {
      echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
      echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
      echo "<p><center>Mengganti Password Sukses</center></p>";
      echo "</div>";
      echo "</div>";
    }
  } ?>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; <a href="https://github.com/Faiznurullah" style="text-decoration: none;"><b>Faiz
            Nurullah</b></a></span>
    </div>
  </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Mau Keluar?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Pilih Logout Jika Anda Ingin Keluar</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>
<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>