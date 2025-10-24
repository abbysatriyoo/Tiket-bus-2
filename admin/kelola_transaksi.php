<?php
include "koneksi.php";

$transaksi = mysqli_query($conn, "
    SELECT t.id_transaksi, u.nama AS nama_user, b.nama_bus, j.asal, j.tujuan,
           j.tanggal, t.jumlah_tiket, t.total_harga, t.status, t.tanggal_pesan
    FROM transaksi t
    JOIN user u ON t.id_user = u.id_user
    JOIN jadwal j ON t.id_jadwal = j.id_jadwal
    JOIN bus b ON j.id_bus = b.id_bus
    ORDER BY t.tanggal_pesan DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Transaksi</title>
    <style>
        body { font-family: Arial; margin: 20px; background-color: #f9f9f9; }
        h2 { color: #007bff; }
        table { width: 100%; border-collapse: collapse; background-color: #fff; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
        th, td { padding: 10px; border: 1px solid #ccc; }
        th { background-color: #007bff; color: white; }
        .status {
            padding: 5px 8px; border-radius: 5px; color: white; font-weight: bold;
        }
        .Pending { background-color: orange; }
        .Lunas { background-color: green; }
        .Batal { background-color: red; }
    </style>
</head>
<body>

<h2>Kelola Transaksi</h2>

<table>
    <tr>
        <th>No</th>
        <th>Nama User</th>
        <th>Bus</th>
        <th>Asal - Tujuan</th>
        <th>Tanggal</th>
        <th>Jumlah Tiket</th>
        <th>Total Harga</th>
        <th>Status</th>
        <th>Tanggal Pesan</th>
    </tr>
    <?php $no=1; while($row = mysqli_fetch_assoc($transaksi)) { ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['nama_user'] ?></td>
        <td><?= $row['nama_bus'] ?></td>
        <td><?= $row['asal'] ?> → <?= $row['tujuan'] ?></td>
        <td><?= $row['tanggal'] ?></td>
        <td><?= $row['jumlah_tiket'] ?></td>
        <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
        <td><span class="status <?= $row['status'] ?>"><?= $row['status'] ?></span></td>
        <td><?= $row['tanggal_pesan'] ?></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
