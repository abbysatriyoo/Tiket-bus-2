<?php
include "koneksi.php";

$asal = $_GET['asal'] ?? '';
$tujuan = $_GET['tujuan'] ?? '';
$tanggal = $_GET['tanggal'] ?? '';

$query = "SELECT * FROM jadwal 
          JOIN bus ON jadwal.id_bus = bus.id_bus
          WHERE asal LIKE '%$asal%' AND tujuan LIKE '%$tujuan%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Pencarian Tiket Bus</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
            margin: 0;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 15px 30px;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .bus-info {
            line-height: 1.6;
        }

        .bus-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .jam {
            color: #555;
        }

        .harga {
            color: #e53935;
            font-weight: bold;
            font-size: 18px;
        }

        .btn-pesan {
            background-color: #007bff;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-pesan:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <header>
        <h2>Hasil Pencarian Tiket Bus</h2>
    </header>

    <div class="container">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="card">
                <div class="bus-info">
                    <div class="bus-name"><?= $row['nama_bus']; ?> (<?= $row['kelas']; ?>)</div>
                    <div class="jam"><?= $row['jam_berangkat']; ?> → <?= $row['jam_tiba']; ?></div>
                    <div><?= $row['asal']; ?> ke <?= $row['tujuan']; ?></div>
                </div>
                <div class="harga">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></div>
                <a href="pesan.php?id=<?= $row['id_jadwal']; ?>" class="btn-pesan">Pesan</a>

            <?php } ?>
            </div>
</body>

</html>