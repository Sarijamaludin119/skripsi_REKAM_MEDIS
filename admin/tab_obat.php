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
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Data Stock Obat:</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <?php
      $jumlah_cos = mysqli_query($conn, "SELECT COUNT(*) as id from obat");
      $row = mysqli_fetch_array($jumlah_cos);
      $jum = $row['id'];
      $hmm = $jum;
      $hal = 10;
      $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
      $start = ($page - 1) * $hal;
      $kap = $hal * $hal;
      ?>
      <div class="row mt-3">
        <div class="col-md-8  mt-4">
          <h7 class="m-0 font-weight-bold">Kapasitas Stock Obat:
            <?php echo $kap; ?>
          </h7><br>
          <a href="export_obat.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mt-1"><i
              class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>
        <div class="col-md-4 mt-5 ">
          <form class="form-inline my-2 my-lg-0" action="cari_obat.php" method="get" name='cari'>
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name='cari'
              required>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </div>
      <?php
      if (isset($_GET['hapus'])) {
        $pesan = addslashes($_GET['hapus']);
        if ($pesan == "sukses") {
          echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
          echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
          echo "<p><center>Sukses Menghapus</center></p>";
          echo "</div>";
          echo "</div>";
        } else {
          echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
          echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
          echo "<p><center>Gagal Menghapus</center></p>";
          echo "</div>";
          echo "</div>";
        }
      }
      ?>
      <div class="table-responsive service">
        <table class="table table-bordered table-hover mt-3 text-nowrap css-serial">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Obat</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Satuan</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <?php
          if (isset($_GET['cari'])) {
            $cari = mysqli_real_escape_string($conn, $_GET['cari']);
            $brg = mysqli_query($conn, "select * from obat where id like '%" . $cari . "%' or nama like '%" . $cari . "%' ");
            if (mysqli_num_rows($brg) > 0) {
              echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
              echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
              echo "<p><center>Data Yang Anda Cari Ditemukan</center></p>";
              echo "</div>";
              echo "</div>";
            } else {
              echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
              echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
              echo "<p><center>$cari Yang Anda Cari Tidak Ditemukan</center></p>";
              echo "</div>";
              echo "</div>";
            }
          } else {
            $brg = mysqli_query($conn, "select * from obat limit $start, $hal");
          }
          if (mysqli_num_rows($brg)) {
            while ($row = mysqli_fetch_array($brg)) {
              ?>
              <tbody>
                <tr>
                  <th scope="row">
                    <?php echo $row['id'] ?>
                  </th>
                  <td>
                    <?php echo $row['nama'] ?>
                  </td>
                  <td>
                    <?php echo $row['keterangan'] ?>
                  </td>
                  <td>
                    <?php echo $row['jumlah'] ?>
                  </td>
                  <td>
                    <?php echo $row['satuan'] ?>
                  </td>
                  <td>&nbsp;<a href="edit_obat.php?id=<?php echo $row['id']; ?>"><button type="button"
                        class="btn btn-success">Edit</button></a> &nbsp; <a
                      href="hapus_obat.php?id=<?php echo $row['id']; ?>"><button type="button"
                        class="btn btn-danger">Hapus</button></a> &nbsp; <a
                      href="detail_obat.php?id=<?php echo $row['id']; ?>"><button type="button"
                        class="btn btn-info">Detail</button></a></td>
                </tr>
              </tbody>
              <?php
            }
          } elseif (mysqli_num_rows($brg) <= 0 and !$cari) {
            echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
            echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
            echo "<p><center>Data Anda Masih Kosong</center></p>";
            echo "</div>";
            echo "</div>";
          }
          ?>
        </table>
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
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Footer -->
<?php
// Require file 'sidebar.php'
require 'footer.php';
?>