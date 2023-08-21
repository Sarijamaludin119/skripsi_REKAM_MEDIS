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
    $det = mysqli_query($conn, "select * from tenagamedis where id='$id_brg'");
    while ($d = mysqli_fetch_array($det)) {
      ?>
      <div class="card shadow  ml-4 mr-4">
        <div class="card-header py-3">
          <h1 class="h3 mb-0 text-gray-800">Edit Data Tenaga Medis</h1>
        </div>
        <form method="post" name='edit'>
          <div class="row ml-5 mb-2 mt-3">
            <div class="col-md-6">
              <P><b>Nama Pasien:</b></p>
              <input class="form-control" type="text" name='nama' placeholder="Nama Baru..."
                value="<?php echo $d['nama']; ?>" required>
              <P><b>Alamat Pasien:</b></p>
              <input class="form-control" type="text" name='alamat' value="<?php echo $d['alamat']; ?>"
                placeholder="Alamat Baru..." required>
              <P><b>Nomor Pasien:</b></p>
              <input class="form-control" type="text" name='nomor' value="<?php echo $d['nomor']; ?>"
                placeholder="Nomor Baru..." required>
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
      $alamat = htmlspecialchars($_POST['alamat']);
      $nomor = htmlspecialchars($_POST['nomor']);
      $edit = mysqli_query($conn, "UPDATE tenagamedis SET
       nama ='$nama',
       alamat ='$alamat',
       nomor = '$nomor'
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