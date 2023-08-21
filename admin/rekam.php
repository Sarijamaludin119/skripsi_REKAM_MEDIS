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
            <h5 class="mb-5"><b>Rekam Medis Pasien</b></h5>
          </center>
          <form action="" name="kirim" method="post">
            <div class="row">
              <div class="col-sm-4">
                <p><b>Nama Pasien:</b></p>
                <select class="form-control" name="pasien" required>
                  <option selected disabled value="">Nama Pasien</option>
                  <?php
                  $brg = mysqli_query($conn, "SELECT * FROM pasien");
                  while ($b = mysqli_fetch_array($brg)) {
                    echo "<option value='" . $b['id'] . "'>" . $b['nama'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="col-sm-4">
                <p><b>Nama Tenaga Medis:</b></p>
                <select class="form-control" name="tenaga" required>
                  <option selected disabled value="">Tenaga Medis</option>
                  <?php
                  $brg = mysqli_query($conn, "SELECT * FROM tenagamedis");
                  while ($b = mysqli_fetch_array($brg)) {
                    echo "<option value='" . $b['id'] . "'>" . $b['nama'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="col-sm-4">
                <p><b>Tanggal Berobat:</b></p>
                <input class="form-control form-control-sm" type="date" aria-label=".form-control-sm example"
                  name="tanggal" required>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-sm-4">
                <p><b>Keluhan:</b></p>
                <textarea name="keluhan" placeholder="Keluhan Pasien...." class="form-control" required></textarea>
              </div>
              <div class="col-sm-4">
                <p><b>Diagnosa:</b></p>
                <textarea name="diagnosa" placeholder="Diagnosa Pasien...." class="form-control" required></textarea>
              </div>
              <div class="col-sm-4">
                <p><b>Obat Medis:</b></p>
                <select class="form-control" name="obat[]" multiple required>
                  <option disabled value="">Obat Medis</option>
                  <?php
                  $brg = mysqli_query($conn, "SELECT * FROM obat WHERE jumlah > 0");
                  while ($b = mysqli_fetch_array($brg)) {
                    echo "<option value='" . $b['id'] . "'>" . $b['nama'] . "</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-info btn-lg btn-block mt-4" name="kirim">Kirim</button>
          </form>
          <?php
          if (isset($_POST['kirim'])) {
            $pasien = mysqli_real_escape_string($conn, $_POST['pasien']);
            $tenaga = mysqli_real_escape_string($conn, $_POST['tenaga']);
            $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
            $keluhan = mysqli_real_escape_string($conn, $_POST['keluhan']);
            $diagnosa = mysqli_real_escape_string($conn, $_POST['diagnosa']);
            $obat = $_POST['obat'];
            $isSuccess = true; // Flag untuk menandai apakah semua operasi berhasil
            foreach ($obat as $selectedObat) {
              $manggil = mysqli_query($conn, "SELECT * FROM obat WHERE id = '$selectedObat'");
              if ($manggil && mysqli_num_rows($manggil) > 0) {
                $total = mysqli_fetch_assoc($manggil);
                $jadi = $total['jumlah'];
                $pengurangan = $jadi - 1;
                if ($pengurangan >= 0) {
                  $insert = mysqli_query($conn, "INSERT INTO rekammedis VALUES (
                        NULL,
                        '$pasien',
                        '$tenaga',
                        '$tanggal',
                        '$keluhan',
                        '$diagnosa',
                        '$selectedObat'
                    )");
                  $update = mysqli_query($conn, "UPDATE obat SET jumlah = '$pengurangan' WHERE id = '$selectedObat'");
                  if (!$insert || !$update) {
                    $isSuccess = false; // Set flag isSuccess menjadi false jika terjadi kegagalan
                    break; // Batalkan proses pengisian data
                  }
                } else {
                  $obatQuery = mysqli_query($conn, "SELECT nama FROM obat WHERE id = '$selectedObat'");
                  $obatData = mysqli_fetch_assoc($obatQuery);
                  $namaObat = $obatData['nama'];
                  echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
                  echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
                  echo "<p><center>Stok Obat '$namaObat' tidak mencukupi</center></p>";
                  echo "</div>";
                  echo "</div>";
                  $isSuccess = false; // Set flag isSuccess menjadi false jika stok obat tidak mencukupi
                  break; // Batalkan proses pengisian data
                }
              } else {
                echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
                echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
                echo "<p><center>Obat dengan ID '$selectedObat' tidak ditemukan</center></p>";
                echo "</div>";
                echo "</div>";
                $isSuccess = false; // Set flag isSuccess menjadi false jika obat tidak ditemukan
                break; // Batalkan proses pengisian data
              }
            }
            if ($isSuccess) {
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
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php
// Require file 'sidebar.php'
require 'footer.php';
?>