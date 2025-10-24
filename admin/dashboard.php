<?php
session_start();
include "koneksi.php";

// (Opsional) cek login admin
// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
//     header("Location: ../index.php");
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Tiket Bus</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 20px 30px;
        }
        .container {
            display: flex;
            min-height: 90vh;
        }
        nav {
            width: 220px;
            background-color: #fff;
            box-shadow: 2px 0 8px rgba(0,0,0,0.1);
            padding: 20px;
        }
        nav h3 {
            color: #007bff;
        }
        nav ul {
            list-style: none;
            padding: 0;
        }
        nav ul li {
            margin: 15px 0;
        }
        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        nav ul li a:hover {
            color: #007bff;
        }
        main {
            flex: 1;
            padding: 30px;
        }
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .stats {
            display: flex;
            gap: 20px;
        }
        .stat-box {
            flex: 1;
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 25px;
            border-radius: 10px;
        }
        .stat-box h2 {
            margin: 0;
            font-size: 28px;
        }
    </style>
</head>
<body>

<header>
    <h1>Dashboard Admin Tiket Bus</h1>
</header>

<div class="container">
    <nav>
        <h3>Menu Admin</h3>
        <ul>
            <li><a href="kelola_bus.php">Kelola Bus</a></li>
            <li><a href="kelola_jadwal.php">Kelola Jadwal</a></li>
            <li><a href="kelola_transaksi.php">Kelola Transaksi</a></li>
            <li><a href="user/index.php">Kembali ke Beranda</a></li>
        </ul>
    </nav>

    <main>
        <h2>Selamat Datang, Admin!</h2>
        <p>Berikut adalah ringkasan data sistem tiket bus:</p>

        <?php
        $bus = mysqli_query($conn, "SELECT COUNT(*) AS total FROM bus");
        $jadwal = mysqli_query($conn, "SELECT COUNT(*) AS total FROM jadwal");
        $transaksi = mysqli_query($conn, "SELECT COUNT(*) AS total FROM transaksi");
        $user = mysqli_query($conn, "SELECT COUNT(*) AS total FROM user WHERE role='user'");

        $busCount = mysqli_fetch_assoc($bus)['total'];
        $jadwalCount = mysqli_fetch_assoc($jadwal)['total'];
        $transCount = mysqli_fetch_assoc($transaksi)['total'];
        $userCount = mysqli_fetch_assoc($user)['total'];
        ?>

        <div class="stats">
            <div class="stat-box">
                <h2><?= $busCount ?></h2>
                <p>Data Bus</p>
            </div>
            <div class="stat-box">
                <h2><?= $jadwalCount ?></h2>
                <p>Jadwal</p>
            </div>
            <div class="stat-box">
                <h2><?= $transCount ?></h2>
                <p>Transaksi</p>
            </div>
            <div class="stat-box">
                <h2><?= $userCount ?></h2>
                <p>Pengguna</p>
            </div>
        </div>

        <div class="card">
            <h3>Panduan Cepat</h3>
            <p>
                - Gunakan menu di kiri untuk menambah atau menghapus data bus dan jadwal.<br>
                - Pantau semua transaksi tiket yang dipesan pengguna.<br>
                - Pastikan data tujuan dan jam keberangkatan sudah benar.
            </p>
        </div>
    </main>
</div>

</body>
</html>
