<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email' AND role='admin'");
    $data = mysqli_fetch_assoc($query);

    if ($data && password_verify($password, $data['password'])) {
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = $data['role'];
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Login gagal! Pastikan data benar.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <style>
        body {
            font-family: Arial; background: #eef2f7; display: flex;
            justify-content: center; align-items: center; height: 100vh;
        }
        form {
            background: white; padding: 25px; border-radius: 10px;
            width: 350px; box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 5px; }
    </style>
</head>
<body>

<form method="POST">
    <h2>Login Admin</h2>
    <input type="email" name="email" placeholder="Email Admin" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
</form>

</body>
</html>
