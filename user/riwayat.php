<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$query = "SELECT transaksi.*, jadwal.asal, jadwal.tujuan, jadwal.jam_berangkat, jadwal.harga, bus.nama_bus
          FROM transaksi
          JOIN jadwal ON transaksi.id_jadwal = jadwal.id_jadwal
          JOIN bus ON jadwal.id_bus = bus.id_bus
          WHERE transaksi.id_user = '$id_user'
          ORDER BY transaksi.tanggal_pesan DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pemesanan</title>
    <style>
        body { font-family: Arial; background-color: #f2f5f9; margin: 0; }
        header { background-color: #007bff; color: white; padding: 15px 30px; display: flex; justify-content: space-between; }
        table {
            width: 90%; margin: 30px auto; border-collapse: collapse; background: white;
            border-radius: 10px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px; text-align: center; border-bottom: 1px solid #ddd;
        }
        th { background-color: #007bff; color: white; }
        tr:hover { background-color: #f1f1f1; }
    </style>
</head>
<body>

<header>
    <h2>Riwayat Pemesanan Tiket</h2>
    <a href="beranda.php" style="color:white;">Kembali ke Beranda</a>
</header>

<table>
    <tr>
        <th>Bus</th>
        <th>Rute</th>
        <th>Jam Berangkat</th>
        <th>Harga</th>
        <th>Tanggal Pesan</th>
        <th>Status</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $row['nama_bus']; ?></td>
        <td><?= $row['asal']; ?> → <?= $row['tujuan']; ?></td>
        <td><?= $row['jam_berangkat']; ?></td>
        <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
        <td><?= $row['tanggal_pesan']; ?></td>
        <td><?= $row['status']; ?></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
