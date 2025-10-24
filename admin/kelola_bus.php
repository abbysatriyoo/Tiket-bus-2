<?php
include "koneksi.php";

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama_bus'];
    $kelas = $_POST['kelas'];
    $fasilitas = $_POST['fasilitas'];

    mysqli_query($conn, "INSERT INTO bus (nama_bus, kelas, fasilitas) 
                         VALUES ('$nama', '$kelas', '$fasilitas')");
    header("Location: kelola_bus.php");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM bus WHERE id_bus=$id");
    header("Location: kelola_bus.php");
}

$bus = mysqli_query($conn, "SELECT * FROM bus");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Bus</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #007bff; color: white; }
        .btn { padding: 6px 10px; border: none; cursor: pointer; }
        .hapus { background-color: red; color: white; }
    </style>
</head>
<body>
    <h2>Kelola Data Bus</h2>
    <form method="POST">
        <input type="text" name="nama_bus" placeholder="Nama Bus" required>
        <input type="text" name="kelas" placeholder="Kelas" required>
        <input type="text" name="fasilitas" placeholder="Fasilitas">
        <button type="submit" name="tambah" class="btn">Tambah</button>
    </form>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Bus</th>
            <th>Kelas</th>
            <th>Fasilitas</th>
            <th>Aksi</th>
        </tr>
        <?php $no=1; while($row = mysqli_fetch_assoc($bus)) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama_bus'] ?></td>
            <td><?= $row['kelas'] ?></td>
            <td><?= $row['fasilitas'] ?></td>
            <td><a class="hapus" href="?hapus=<?= $row['id_bus'] ?>">Hapus</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
