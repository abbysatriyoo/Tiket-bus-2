<?php
// pesan.php — letakkan di folder yang sama dengan beranda.php & koneksi.php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "koneksi.php"; // sesuaikan path jika perlu

// Pastikan user login
if (!isset($_SESSION['id_user'])) {
    // jika belum login, arahkan ke login dan beri pesan
    echo "<script>alert('Silakan login terlebih dahulu.'); window.location='login.php';</script>";
    exit;
}

$id_user = $_SESSION['id_user'];

// Validasi parameter id
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID jadwal tidak ditemukan.'); window.location='beranda.php';</script>";
    exit;
}

$id_jadwal = intval($_GET['id']); // sanitasi

// Ambil data jadwal (sesuaikan nama tabel/kolom dengan database kamu)
$sql = "SELECT jadwal.*, bus.nama_bus, bus.kelas 
        FROM jadwal 
        JOIN bus ON jadwal.id_bus = bus.id_bus
        WHERE jadwal.id_jadwal = ?";
$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    die("Prepare failed: " . mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, "i", $id_jadwal);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($res);

if (!$data) {
    echo "<script>alert('Jadwal tidak ditemukan di database.'); window.location='beranda.php';</script>";
    exit;
}

// Jika form dipost (pesan)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['jumlah_tiket'])) {

    $jumlah_tiket = intval($_POST['jumlah_tiket']);
    if ($jumlah_tiket < 1) {
        echo "<script>alert('Jumlah tiket minimal 1');</script>";
    } else {
        // Pastikan harga tidak null
        $harga = isset($data['harga']) ? intval($data['harga']) : 0;
        $total_harga = $jumlah_tiket * $harga;

        // Cek apakah ada kolom NOT NULL di tabel transaksi yang harus diisi
        // lalu lakukan insert dengan prepared statement
        $insert_sql = "INSERT INTO transaksi (id_user, id_jadwal, jumlah_tiket, total_harga, tanggal_pesan) 
                       VALUES (?, ?, ?, ?, NOW())";
        $ins_stmt = mysqli_prepare($conn, $insert_sql);
        if (!$ins_stmt) {
            // tampilkan error db (berguna untuk debug)
            die("Prepare insert failed: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($ins_stmt, "iiii", $id_user, $id_jadwal, $jumlah_tiket, $total_harga);
        $ok = mysqli_stmt_execute($ins_stmt);

        if ($ok) {
            echo "<script>alert('Tiket berhasil dipesan!'); window.location='riwayat.php';</script>";
            exit;
        } else {
            // beri pesan error yang informatif
            $dberr = mysqli_stmt_error($ins_stmt);
            echo "<script>alert('Gagal memesan tiket: " . addslashes($dberr) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Pesan Tiket</title>
    <style>
        body { font-family: Arial; background:#f4f4f4; padding:20px; }
        .card { background:#fff; width:480px; margin:40px auto; padding:20px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1); }
        input, button { width:100%; padding:10px; margin:8px 0; border-radius:6px; border:1px solid #ccc; }
        button { background:#28a745; color:#fff; border:none; cursor:pointer; }
        a { text-decoration:none; color:#007bff; display:inline-block; margin-top:10px; }
    </style>
</head>
<body>
<div class="card">
    <h2>Pesan Tiket</h2>

    <p><strong>Bus:</strong> <?= htmlspecialchars($data['nama_bus'] ?? '-') ?> (<?= htmlspecialchars($data['kelas'] ?? '-') ?>)</p>
    <p><strong>Rute:</strong> <?= htmlspecialchars($data['asal'] ?? '-') ?> → <?= htmlspecialchars($data['tujuan'] ?? '-') ?></p>
    <p><strong>Tanggal:</strong> <?= htmlspecialchars($data['tanggal'] ?? '-') ?></p>
    <p><strong>Berangkat:</strong> <?= htmlspecialchars($data['jam_berangkat'] ?? '-') ?> — <strong>Tiba:</strong> <?= htmlspecialchars($data['jam_tiba'] ?? '-') ?></p>
    <p><strong>Harga:</strong> Rp <?= number_format(intval($data['harga'] ?? 0), 0, ',', '.') ?></p>

    <form method="POST" action="">
        <label for="jumlah_tiket">Jumlah Tiket</label>
        <input type="number" name="jumlah_tiket" id="jumlah_tiket" min="1" value="1" required>
        <button type="submit">Pesan Sekarang</button>
    </form>

    <a href="beranda.php">⬅ Kembali ke Beranda</a>
</div>
</body>
</html>
