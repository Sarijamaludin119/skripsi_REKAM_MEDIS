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
    <title>Detail Pasien</title>
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
        <h2>Info Detail Pasien</h2>
        <?php
        if (isset($_GET['id'])) {
            $id_brg = $_GET['id'];
            $det = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$id_brg'") or die(mysqli_error($conn));
            while ($d = mysqli_fetch_array($det)) {
        ?>
                <table>
                    <tr>
                        <th>Nama Pasien</th>
                        <td><?php echo $d['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>Nik Pasien</th>
                        <td><?php echo $d['nik']; ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td><?php echo $d['kelamin']; ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><?php echo $d['alamat']; ?></td>
                    </tr>
                    <tr>
                        <th>Nomor Handphone</th>
                        <td><?php echo $d['nomor']; ?></td>
                    </tr>
                    <tr>
                        <th>Keluhan Pasien</th>
                        <td style="height: 100px;"></td>
                    </tr>
                    <tr>
                        <th>Diagnosa</th>
                        <td style="height: 100px;"></td>
                    </tr>
                    <tr>
                        <th>Obat</th>
                        <td style="height: 100px;"></td>
                    </tr>
                    <tr>
                        <th>Nama dan TTD Tenaga Medis</th>
                        <td style="height: 100px;"></td>
                    </tr>
                </table>
        <?php
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