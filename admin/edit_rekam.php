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
    $det = mysqli_query($conn, "select * from rekammedis where id='$id_brg'");
    while ($d = mysqli_fetch_array($det)) {
      ?>
      <div class="card shadow  ml-4 mr-4">
        <div class="card-header py-3">
          <h1 class="h3 mb-0 text-gray-800">Edit Rekam Medis</h1>
        </div>
        <form method="post" name='edit'>
          <div class="row ml-5 mb-2 mt-3">
            <div class="col-md-6">
              <P><b>Nama Pasien:</b></p>
              <select class="form-control" name='nama' required>
                <option selected disabled value="">Nama Pasien</option>
                <?php
                $brg = mysqli_query($conn, "select * from pasien");
                while ($b = mysqli_fetch_array($brg)) {
                  ?>
                  <option value="<?php echo $b['nama']; ?>"><?php echo $b['nama']; ?></option>
                <?php } ?>
              </select>
              <P><b>Tenaga Medis:</b></p>
              <select class="form-control" name='tenaga' required>
                <option selected disabled value="">Tenaga Medis</option>
                <?php
                $brg = mysqli_query($conn, "select * from tenagamedis");
                while ($b = mysqli_fetch_array($brg)) {
                  ?>
                  <option value="<?php echo $b['nama']; ?>"><?php echo $b['nama']; ?></option>
                <?php } ?>
              </select>
              <P><b>Tanggal Berobat:</b></p>
              <input class="form-control" type="date" name='tanggal' value="<?php echo $d['tanggal']; ?>" required>
              <P><b>Keluhan Pasien:</b></p>
              <input class="form-control" type="text" name='keluhan' value="<?php echo $d['keluhan']; ?>"
                placeholder="Keluhan Baru..." required>
              <P><b>Diagnosa Pasien:</b></p>
              <input class="form-control" type="text" name='diagnosa' value="<?php echo $d['diagnosa']; ?>"
                placeholder="Diagnosa Baru..." required>
              <P><b>Obat Pasien:</b></p>
              <select class="form-control" name='obat' required>
                <option selected disabled value="">Obat Medis</option>
                <?php
                $brg = mysqli_query($conn, "select * from obat");
                while ($b = mysqli_fetch_array($brg)) {
                  ?>
                  <option value="<?php echo $b['nama']; ?>"><?php echo $b['nama']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row ml-5 mb-4 mt-3">
            <div class="col-md-5">
              <button type="submit" class="btn btn-info" name='edit'>Update</button>&nbsp;<input type="reset"
                class="btn btn-danger" value="Reset">
            </div>
          </div>
        </form>
      <?php }
  } ?>
    <?php
    if (isset($_POST['edit'])) {
      $nama = htmlspecialchars($_POST['nama']);
      $tenaga = htmlspecialchars($_POST['tenaga']);
      $tanggal = htmlspecialchars($_POST['tanggal']);
      $keluhan = htmlspecialchars($_POST['keluhan']);
      $diagnosa = htmlspecialchars($_POST['diagnosa']);
      $obat = htmlspecialchars($_POST['obat']);
      $edit = mysqli_query($conn, "UPDATE rekammedis SET
       nama_pasien ='$nama',
       nama_tenaga ='$tenaga',
       tanggal ='$tanggal',
       keluhan = '$keluhan',
       diagnosa ='$diagnosa',
       obat ='$obat'
        WHERE id ='" . $_GET['id'] . "'
            ");
      if ($edit) {
        echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
        echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
        echo "<p><center>Mengedit Data Sukses</center></p>";
        echo "</div>";
        echo "</div>";
      } else {
        echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
        echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
        echo "<p><center>Mengedit Data Gagal</center></p>";
        echo "</div>";
        echo "</div>";
      }
    }
    ?>
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