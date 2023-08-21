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
    $det = mysqli_query($conn, "SELECT * FROM obat WHERE id='$id_brg'");
    while ($d = mysqli_fetch_array($det)) {
      ?>
      <div class="card shadow ml-4 mr-4">
        <div class="card-header py-3">
          <h1 class="h3 mb-0 text-gray-800">Edit Data Obat</h1>
        </div>
        <form method="post" name='edit'>
          <div class="row ml-5 mb-2 mt-3">
            <div class="col-md-6">
              <p><b>Nama Obat:</b></p>
              <input class="form-control" type="text" name='nama' placeholder="Nama Baru..."
                value="<?php echo $d['nama']; ?>" required>
              <p><b>Keterangan</b></p>
              <input class="form-control" type="text" name='keterangan' value="<?php echo $d['keterangan']; ?>"
                placeholder="Keterangan Baru..." required>
              <p><b>Jumlah Obat</b></p>
              <input class="form-control" type="text" name='jumlah' value="<?php echo $d['jumlah']; ?>"
                placeholder="Jumlah Baru..." required>
              <p><b>Satuan Obat</b></p>
              <select class="form-control" name="satuan" required>
                <option value="">
                  <?php echo $d['satuan']; ?>
                </option>
                <option value="Tablet" <?php if ($d['satuan'] == 'Tablet')
                  echo 'selected'; ?>>Tablet</option>
                <option value="Kapsul" <?php if ($d['satuan'] == 'Kapsul')
                  echo 'selected'; ?>>Kapsul</option>
                <option value="Sirup" <?php if ($d['satuan'] == 'Sirup')
                  echo 'selected'; ?>>Sirup</option>
                <!-- Tambahkan opsi satuan lainnya di sini -->
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
        <?php
    }
  }
  ?>
    <?php
    if (isset($_POST['edit'])) {
      $nama = htmlspecialchars($_POST['nama']);
      $keterangan = htmlspecialchars($_POST['keterangan']);
      $jumlah = htmlspecialchars($_POST['jumlah']);
      $satuan = htmlspecialchars($_POST['satuan']);
      $edit = mysqli_query($conn, "UPDATE obat SET
    nama ='$nama',
    keterangan ='$keterangan',
    jumlah = '$jumlah',
    satuan = '$satuan'
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