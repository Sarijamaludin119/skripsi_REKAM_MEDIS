<?php
session_start();
if (!isset($_SESSION['password']) || empty($_SESSION['password'])) {
    header("location: login.php");
    exit(); // Added exit to prevent further execution
}
include '../config/koneksi.php';
error_reporting(E_ALL); // Set error reporting to show all errors
?>
<!DOCTYPE html>
<html>

<head>
    <title>Detail Rekam Medis</title>
    <style>
        /* CSS untuk format halaman cetak */
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Detail Rekam Medis</h2>
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
                <table>
                    <tr>
                        <th>Nama Pasien</th>
                        <td><?php echo $row['nama_pasien']; ?></td>
                    </tr>
                    <tr>
                        <th>Tenaga Medis</th>
                        <td><?php echo $row['nama_tenaga_medis']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Berobat</th>
                        <td><?php echo $row['tanggal']; ?></td>
                    </tr>
                    <tr>
                        <th>Keluhan</th>
                        <td><?php echo $row['keluhan']; ?></td>
                    </tr>
                    <tr>
                        <th>Diagnosa</th>
                        <td><?php echo $row['diagnosa']; ?></td>
                    </tr>
                    <tr>
                        <th>Obat</th>
                        <td><?php echo $row['nama_obat']; ?></td>
                    </tr>
                </table>
        <?php
            } else {
                echo "<p>Tidak ada data rekam medis untuk pasien ini.</p>";
            }
        }
        ?>
    </div>
    <script>
        // Trigger printing automatically when the page loads
        window.onload = function() {
            window.print(); // Automatically trigger print
        };
    </script>
</body>

</html>