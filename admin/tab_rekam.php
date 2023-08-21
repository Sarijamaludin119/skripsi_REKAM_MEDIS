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
      <h6 class="m-0 font-weight-bold text-primary">Data Rekam Medis :</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <?php
      $jumlah_cos = mysqli_query($conn, "SELECT COUNT(*) as id from tenagamedis");
      $row = mysqli_fetch_array($jumlah_cos);
      $jum = $row['id'];
      $hmm = $jum;
      $hal = 5;
      $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
      $start = ($page - 1) * $hal;
      $kap = $hal * $hal;
      ?>
      <div class="row mt-3">
        <div class="col-md-8  mt-4">
          <h7 class="m-0 font-weight-bold">Kapasitas Tenaga Medis:
            <?php echo $kap; ?>
          </h7><br>
          <a href="export_rekam.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mt-1"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>
        <div class="col-md-4 mt-5 ">
          <form class="form-inline my-2 my-lg-0" action="cari_rekam.php" method="get" name='cari'>
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name='cari' required>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </div>
      <?php
      if (isset($_GET['hapus'])) {
        $pesan = addslashes($_GET['hapus']);
        if ($pesan == "sukses") {
          echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
          echo "<p><center>Sukses Menghapus</center></p>";
          echo "</div>";
        } else {
          echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
          echo "<p><center>Gagal Menghapus</center></p>";
          echo "</div>";
        }
      }
      ?>
      <div class="table-responsive service">
        <table class="table table-bordered table-hover mt-3 text-nowrap css-serial">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Pasien</th>
              <th scope="col">Tenaga Medis</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Keluhan</th>
              <th scope="col">Diagnosa</th>
              <th scope="col">Obat</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1; // Inisialisasi nomor awal
            if (isset($_GET['cari'])) {
              $cari = mysqli_real_escape_string($conn, $_GET['cari']);
              $brg = mysqli_query($conn, "SELECT rekammedis.id_pasien, 
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
                                        WHERE rekammedis.id LIKE '%" . $cari . "%' OR pasien.nama LIKE '%" . $cari . "%'
                                        GROUP BY rekammedis.id_pasien");
            } else {
              $brg = mysqli_query($conn, "SELECT rekammedis.id_pasien, 
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
                                        GROUP BY rekammedis.id_pasien");
            }
            if (mysqli_num_rows($brg) > 0) {
              while ($row = mysqli_fetch_array($brg)) {
            ?>
                <tr>
                  <td>
                    <?php echo $no++; ?>
                  </td>
                  <td>
                    <?php echo $row['nama_pasien']; ?>
                  </td>
                  <td>
                    <?php echo $row['nama_tenaga_medis']; ?>
                  </td>
                  <td>
                    <?php echo $row['tanggal']; ?>
                  </td>
                  <td>
                    <?php echo $row['keluhan']; ?>
                  </td>
                  <td>
                    <?php echo $row['diagnosa']; ?>
                  </td>
                  <td>
                    <?php echo $row['nama_obat']; ?>
                  </td>
                  <td>&nbsp;<a href="edit_rekam.php?id=<?php echo $row['id_pasien']; ?>"><button type="button" class="btn btn-success">Edit</button></a> &nbsp; <a href="hapus_rekam.php?id=<?php echo $row['id_pasien']; ?>"><button type="button" class="btn btn-danger">Hapus</button></a> &nbsp; <a href="detail_rekam.php?id=<?php echo $row['id_pasien']; ?>"><button type="button" class="btn btn-info">Detail</button></a></td>
                </tr>
            <?php
              }
            } else {
              echo "<tr><td colspan='8'>Tidak ada data rekam medis.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <?php
          for ($x = 1; $x <= $hal; $x++) {
          ?>
            <li class="page-item"><a class="page-link" href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
          <?php
          }
          ?>
        </ul>
      </nav>
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