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
            <h5 class="mb-5"><b>Tambah Obat Medis</b></h5>
          </center>
          <form action="" name="kirim" method="post">
            <div class="row">
              <div class="col-sm-3">
                <label>Nama Obat Medis:</label>
                <input class="form-control form-control-sm" type="text" placeholder="Nama Obat Medis..."
                  aria-label=".form-control-sm example" name="nama" required>
              </div>
              <div class="col-sm-4">
                <label>Keterangan Obat Medis:</label>
                <input class="form-control form-control-sm" type="text" placeholder="Keterangan Obat Medis..."
                  aria-label=".form-control-sm example" name="keterangan" required>
              </div>
              <div class="col-sm-2">
                <label>Stock Obat Medis:</label>
                <input class="form-control form-control-sm" type="number" placeholder="Stock Obat Medis..."
                  aria-label=".form-control-sm example" name="jumlah" required>
              </div>
              <div class="col-sm-3">
                <label>Satuan Obat:</label>
                <select class="form-control form-control-sm" name="satuan" required>
                  <option value="tablet">Tablet</option>
                  <option value="kapsul">Kapsul</option>
                  <option value="botol">Botol</option>
                  <option value="ampul">Ampul</option>
                  <!-- Tambahkan opsi satuan obat sesuai kebutuhan -->
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-info btn-lg btn-block mt-4" name="kirim">Kirim</button>
          </form>
          <?php
          if (isset($_POST['kirim'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $keterangan = htmlspecialchars($_POST['keterangan']);
            $jumlah = htmlspecialchars($_POST['jumlah']);
            $satuan = htmlspecialchars($_POST['satuan']);
            $wet = mysqli_query($conn, "select * from obat where nama ='$nama' and keterangan like '%" . $keterangan . "%'");
            $chak = mysqli_num_rows($wet);
            if ($chak > 0) {
              $rew = mysqli_fetch_array($wet);
              $nama === $rew['nama'];
              $keterangan === $rew['keterangan'];
              echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
              echo "<div class='alert alert-warning mt-4 ml-5' role='alert'>";
              echo "<p><center>Data Yang Anda Kirim Sudah Tersedia</center></p>";
              echo "</div>";
              echo "</div>";
            } else {
              $insert = mysqli_query($conn, "INSERT INTO obat VALUES (
                      NULL,
                      '$nama',
                      '$keterangan',
                      '$jumlah',
                      '$satuan'
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