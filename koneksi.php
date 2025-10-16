<?php
$host = "localhost";
$user = "root"; // ganti jika pakai user lain
$pass = "";
$db = "tiketbus"; // sesuaikan dengan nama databasenya

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
