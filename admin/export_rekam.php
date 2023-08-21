<?php
include '../config/koneksi.php';
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<!--ini awal content-->
<h3>
  <p class="text-center mt-4">Data Rekam Medis Puskesmas Perawatan Hitu</p>
</h3>
<center>
  <table class=" mt-4" width="1000px" border="1">
    <tr>
      <td>
        <center>No</center>
      </td>
      <td>
        <center>Nama</center>
      </td>
      <td>
        <center>Tenaga Medis</center>
      </td>
      <td>
        <center>Tanggal Berobat</center>
      </td>
      <td>
        <center>Keluhan</center>
      </td>
      <td>
        <center>Diagnosa</center>
      </td>
      <td>
        <center>Obat</center>
      </td>
    </tr>
    <?php
    $query = mysqli_query($conn, "SELECT rekammedis.id, pasien.nama AS nama_pasien, tenagamedis.nama AS nama_tenaga_medis, rekammedis.tanggal, rekammedis.keluhan, rekammedis.diagnosa, obat.nama AS nama_obat
            FROM rekammedis
            INNER JOIN pasien ON rekammedis.id_pasien = pasien.id
            INNER JOIN tenagamedis ON rekammedis.id_tenaga_medis = tenagamedis.id
            INNER JOIN obat ON rekammedis.id_obat = obat.id;
            ");
    $no = 1; // Inisialisasi nomor awal
    while ($row = mysqli_fetch_array($query)) {
      ?>
      <tr>
        <td>
          <center>
            <?php echo $no++; ?>
        </td>
        <td>
          <center>
            <?php echo $row['nama_pasien'] ?>
        </td>
        <td>
          <center>
            <?php echo $row['nama_tenaga_medis'] ?>
        </td>
        <td>
          <center>
            <?php echo $row['tanggal'] ?>
        </td>
        <td>
          <center>
            <?php echo $row['keluhan'] ?>
        </td>
        <td>
          <center>
            <?php echo $row['diagnosa'] ?>
        </td>
        <td>
          <center>
            <?php echo $row['nama_obat'] ?>
        </td>
      </tr>
      <?php
    }
    ?>
  </table>
</center>
<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Data_Rekam_klinik.xls");
?>
<!--ini akhir content bosq-->
<!-- Optional JavaScript -->
<!-- Popper.js first, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
  integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>

</html>