<?php
include "koneksi.php";

// Proses tambah jadwal
if (isset($_POST['tambah'])) {
    $id_bus = $_POST['id_bus'];
    $asal = $_POST['asal'];
    $tujuan = $_POST['tujuan'];
    $jam_berangkat = $_POST['jam_berangkat'];
    $jam_tiba = $_POST['jam_tiba'];
    $harga = $_POST['harga'];
    $tanggal = $_POST['tanggal'];

    mysqli_query($conn, "INSERT INTO jadwal (id_bus, asal, tujuan, jam_berangkat, jam_tiba, harga, tanggal)
                         VALUES ('$id_bus', '$asal', '$tujuan', '$jam_berangkat', '$jam_tiba', '$harga', '$tanggal')");
    header("Location: kelola_jadwal.php");
}

// Hapus jadwal
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM jadwal WHERE id_jadwal=$id");
    header("Location: kelola_jadwal.php");
}

$bus = mysqli_query($conn, "SELECT * FROM bus");
$jadwal = mysqli_query($conn, "SELECT jadwal.*, bus.nama_bus, bus.kelas 
                               FROM jadwal 
                               JOIN bus ON jadwal.id_bus = bus.id_bus
                               ORDER BY tanggal ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Jadwal Bus</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f9f9f9; }
        h2 { color: #007bff; }
        form {
            background: #fff; padding: 15px; border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        input, select {
            margin: 6px 0; padding: 8px; width: calc(50% - 10px);
        }
        button {
            background-color: #007bff; color: white; padding: 8px 12px;
            border: none; border-radius: 5px; cursor: pointer;
        }
        button:hover { background-color: #0056b3; }
        table {
            width: 100%; border-collapse: collapse; margin-top: 25px;
            background-color: white; box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        th { background-color: #007bff; color: white; }
        a.hapus {
            background-color: red; color: white; padding: 6px 10px;
            text-decoration: none; border-radius: 5px;
        }
    </style>
</head>
<body>

<h2>Kelola Jadwal Bus</h2>

<form method="POST">
    <select name="id_bus" required>
        <option value="">Pilih Bus</option>
        <?php while($b = mysqli_fetch_assoc($bus)) { ?>
            <option value="<?= $b['id_bus'] ?>"><?= $b['nama_bus'] ?> (<?= $b['kelas'] ?>)</option>
        <?php } ?>
    </select><br>
    <input type="text" name="asal" placeholder="Kota Asal" required>
    <input type="text" name="tujuan" placeholder="Kota Tujuan" required><br>
    <input type="time" name="jam_berangkat" required>
    <input type="time" name="jam_tiba" required><br>
    <input type="number" name="harga" placeholder="Harga Tiket" required>
    <input type="date" name="tanggal" required><br>
    <button type="submit" name="tambah">Tambah Jadwal</button>
</form>

<table>
    <tr>
        <th>No</th>
        <th>Bus</th>
        <th>Asal</th>
        <th>Tujuan</th>
        <th>Berangkat</th>
        <th>Tiba</th>
        <th>Tanggal</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>
    <?php $no=1; while($row = mysqli_fetch_assoc($jadwal)) { ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['nama_bus'] ?> (<?= $row['kelas'] ?>)</td>
        <td><?= $row['asal'] ?></td>
        <td><?= $row['tujuan'] ?></td>
        <td><?= $row['jam_berangkat'] ?></td>
        <td><?= $row['jam_tiba'] ?></td>
        <td><?= $row['tanggal'] ?></td>
        <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
        <td><a class="hapus" href="?hapus=<?= $row['id_jadwal'] ?>">Hapus</a></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
