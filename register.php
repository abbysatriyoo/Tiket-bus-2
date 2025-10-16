<?php
include "koneksi.php";

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // cek email
    $cek = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Email sudah terdaftar!');</script>";
    } else {
        $query = "INSERT INTO user (nama, email, password, role) VALUES ('$nama','$email','$password','user')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Gagal mendaftar. Coba lagi.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register User</title>
    <style>
        body {
            font-family: Arial, sans-serif; background: #eef2f7; display: flex;
            justify-content: center; align-items: center; height: 100vh;
        }
        form {
            background: white; padding: 25px; border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 350px;
        }
        input {
            width: 100%; padding: 10px; margin: 10px 0;
            border: 1px solid #ccc; border-radius: 5px;
        }
        button {
            width: 100%; padding: 10px; background: #007bff;
            color: white; border: none; border-radius: 5px;
        }
        a { text-decoration: none; color: #007bff; }
    </style>
</head>
<body>

<form method="POST">
    <h2>Daftar Akun Baru</h2>
    <input type="text" name="nama" placeholder="Nama Lengkap" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="register">Daftar</button>
    <p>Sudah punya akun? <a href="login.php">Login</a></p>
</form>

</body>
</html>
