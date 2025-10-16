<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    $data = mysqli_fetch_assoc($query);

    if ($data && password_verify($password, $data['password'])) {
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = $data['role'];

        if ($data['role'] == 'admin') {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: beranda.php");
        }
        exit;
    } else {
        echo "<script>alert('Email atau password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Tiket Bus</title>
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
    <h2>Login Tiket Bus</h2>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
    <p>Belum punya akun? <a href="register.php">Daftar</a></p>
</form>

</body>
</html>
