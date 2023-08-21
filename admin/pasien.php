<?php
session_start();
if ($_SESSION['password'] == '') {
  header("location: login.php");
}
include '../config/koneksi.php';
?>
<?php
// Require file 'sidebar.php'
require 'nav.php';
?>

<!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row mt-5">
    <div class="col-xl-1">
    </div>
    <div class="col-xl-12 col-lg-8">
      <div class="card shadow mb-4">
        <!-- Card Body -->
        <div class="card-body">
          <center>
            <h5 class="mb-5"><b>Tambah Pasien</b></h5>
          </center>
          <form action='' name='kirim' method='post'>
            <div class="row">
              <div class="col-sm-4">
                <label>NIK:</label>
                <input class="form-control form-control-sm" type="number" placeholder="NIK Pasien..."
                  aria-label=".form-control-sm example" name='nick' required>
              </div>
              <div class="col-sm-4">
                <label>Nama Pasien:</label>
                <input class="form-control form-control-sm" type="text" placeholder="Nama Pasien..."
                  aria-label=".form-control-sm example" name='nama' required>
              </div>
              <div class="col-sm-4">
                <label>Jenis Kelamin:</label>
                <select class="form-control" name='gender' required>
                  <option selected disabled value="">Jenis Kelamin...</option>
                  <option value="laki-laki">Laki-Laki</option>
                  <option value="perempuan">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-4">
                <label>Alamat:</label>
                <input class="form-control form-control-sm" type="text" placeholder="Alamat Pasien..."
                  aria-label=".form-control-sm example" name='alamat' required>
              </div>
              <div class="col-sm-4">
                <label>nomor:</label>
                <input class="form-control form-control-sm" type="number" placeholder="Nomor Handphone Pasien..."
                  aria-label=".form-control-sm example" name='nomor' required>
              </div>
              <div class="col-sm-4">
              </div>
            </div>
            <button type="submit" class="btn btn-info btn-lg btn-block mt-4" name='kirim'>Kirim</button>
          </form>
          <?php
          if (isset($_POST['kirim'])) {
            $nick = htmlspecialchars($_POST['nick']);
            $nama = htmlspecialchars($_POST['nama']);
            $gander = htmlspecialchars($_POST['gender']);
            $alamat = htmlspecialchars($_POST['alamat']);
            $nomor = htmlspecialchars($_POST['nomor']);
            $wet = mysqli_query($conn, "select * from pasien where nama ='$nama' and kelamin='$gander' and nik ='$nick' and alamat='$alamat' and nomor='$nomor'");
            $chak = mysqli_num_rows($wet);
            if ($chak > 0) {
              $rew = mysqli_fetch_array($wet);
              $nama === $rew['nama'];
              $nick === $rew['nik'];
              $gander === $rew['kelamin'];
              $alamat === $rew['alamat'];
              $nomor === $rew['nomor'];
              echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
              echo "<div class='alert alert-warning mt-4 ml-5' role='alert'>";
              echo "<p><center>Data Yang Anda Kirim Sudah Tersedia</center></p>";
              echo "</div>";
              echo "</div>";
            } else {
              $insert = mysqli_query($conn, "INSERT INTO pasien VALUES (
      NULL,
      '$nick',
      '$nama',
      '$gander',
      '$alamat',
      '$nomor'
        )");
              if ($insert) {
                echo "<div class='col-md-10 col-sm-12 col-xs-12'>";
                echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
                echo "<p><center>Data Sudah Masuk</center></p>";
                echo "</div>";
                echo "</div>";
              } else {
                echo "<div class='col-md-10 col-sm-12 col-xs-12'>";
                echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
                echo "<p><center>Data Gagal Masuk</center></p>";
                echo "</div>";
                echo "</div>";
              }
            }
          }
          ?>
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