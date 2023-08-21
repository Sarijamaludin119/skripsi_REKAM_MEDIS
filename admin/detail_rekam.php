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
<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Detail Rekam Medis :</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="table-responsive service">
        <table class="table table-bordered mt-3 text-nowrap">
          <tbody>
            <?php
            if (isset($_GET['id'])) {
              $id_pasien = $_GET['id'];
              $query = "SELECT rekammedis.id_pasien, 
                               GROUP_CONCAT(DISTINCT pasien.nama) AS nama_pasien,
                               GROUP_CONCAT(DISTINCT tenagamedis.nama) AS nama_tenaga_medis,
                               GROUP_CONCAT(DISTINCT rekammedis.tanggal) AS tanggal,
                               GROUP_CONCAT(DISTINCT rekammedis.keluhan) AS keluhan,
                               GROUP_CONCAT(DISTINCT rekammedis.diagnosa) AS diagnosa,
                               GROUP_CONCAT(DISTINCT obat.nama) AS nama_obat
                        FROM rekammedis
                        INNER JOIN pasien ON rekammedis.id_pasien = pasien.id
                        INNER JOIN tenagamedis ON rekammedis.id_tenaga_medis = tenagamedis.id
                        INNER JOIN obat ON rekammedis.id_obat = obat.id
                        WHERE rekammedis.id_pasien = '$id_pasien'
                        GROUP BY rekammedis.id_pasien";
              $result = mysqli_query($conn, $query);

              if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
            ?>
                <tr>
                  <th scope="row">Nama Pasien</th>
                  <td><?php echo $row['nama_pasien']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Tenaga Medis</th>
                  <td><?php echo $row['nama_tenaga_medis']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Tanggal Berobat</th>
                  <td><?php echo $row['tanggal']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Keluhan</th>
                  <td><?php echo $row['keluhan']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Diagnosa</th>
                  <td><?php echo $row['diagnosa']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Obat</th>
                  <td><?php echo $row['nama_obat']; ?></td>
                </tr>
            <?php
              } else {
                echo "<tr><td colspan='2'>Tidak ada data rekam medis untuk pasien ini.</td></tr>";
              }
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="row">
        <div class="col-md-9">
        </div>
        <div class="col-md-3">
          <a href="tab_rekam.php"><button type="button" class="btn btn-info">Kembali</button></a>
          <a href="print_rekam.php?id=<?php echo $_GET['id']; ?>" target="_blank"><button type="button" class="btn btn-warning">Print</button></a>
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