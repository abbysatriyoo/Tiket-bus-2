<?php
// index.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Sabi Travel - Cari Tiket Bus</title>
  <style>
    body {
      margin: 0;
      font-family: "Poppins", Arial, sans-serif;
      background: url('bus.jpg') no-repeat center center fixed;
      background-size: cover;
    }

    /* HEADER */
    .navbar {
      background-color: #ffcc00;
      color: #222;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 40px;
      font-weight: 500;
    }

    .navbar .brand {
      font-size: 22px;
      font-weight: 700;
      color: #1a1a1a;
    }

    .navbar .menu {
      display: flex;
      align-items: center;
      gap: 25px;
      font-size: 14px;
    }

    .navbar .menu a {
      text-decoration: none;
      color: #1a1a1a;
      transition: 0.3s;
    }

    .navbar .menu a:hover {
      text-decoration: underline;
    }

    /* HERO / CONTENT */
    .hero {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      color: white;
      padding: 80px 20px;
      background: rgba(0, 0, 0, 0.55);
      min-height: 100vh;
    }

    .hero h1 {
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .hero p {
      font-size: 16px;
      opacity: 0.9;
      margin-bottom: 40px;
    }

    /* FORM PENCARIAN */
    .search-box {
      background: rgba(0, 0, 0, 0.7);
      border-radius: 10px;
      padding: 25px;
      width: 90%;
      max-width: 800px;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
    }

    .search-box input {
      padding: 12px;
      border: none;
      border-radius: 6px;
      font-size: 14px;
      flex: 1 1 180px;
    }

    .search-box button {
      background-color: #ffcc00;
      color: #000;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      padding: 12px 25px;
      cursor: pointer;
      transition: 0.3s;
    }

    .search-box button:hover {
      background-color: #ffd84d;
    }

    /* FOOTER / DOA */
    .footer {
      margin-top: 50px;
      font-size: 14px;
      color: #fff;
      background: rgba(0, 0, 0, 0.6);
      padding: 15px;
      border-radius: 10px;
      max-width: 700px;
    }

    .footer .arab {
      font-size: 20px;
      margin-bottom: 10px;
      line-height: 1.8;
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        text-align: center;
      }
      .search-box {
        flex-direction: column;
        align-items: stretch;
      }
      .search-box input,
      .search-box button {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <!-- HEADER -->
  <div class="navbar">
    <div class="brand">PO. ABY JAYA</div>
    <div class="menu">
      <a href="#">Beranda</a>
      <a href="#">Cek Tiket</a>
      <a href="login.php"><strong>Login</strong></a>
    </div>
  </div>

  <!-- HERO SECTION -->
  <div class="hero">
    <h1>Cari Tiket Bus PO. ABY JAYA</h1>
    <p>Situs resmi pemesanan tiket bus Sabi Travel — nyaman, cepat, dan terpercaya.</p>

    <form class="search-box" action="results.php" method="get">
      <input type="text" name="origin" placeholder="Kota Asal (mis: Jakarta)" required>
      <input type="text" name="destination" placeholder="Kota Tujuan (mis: Yogyakarta)" required>
      <input type="date" name="date" required>
      <button type="submit"><a href="beranda.php">Cari Tiket</a></button>
    </form>

    <div class="footer">
      <div class="arab">
        سُبْحَانَ الَّذِيْ سَخَّرَ لَنَا هَذَا وَمَا كُنَّا لَهُ مُقْرِنِيْنَ وَإِنَّا إِلَى رَبِّنَا لَمُنْقَلِبُوْنَ
      </div>
      <p>Artinya: “Maha Suci Allah yang telah menundukkan (kendaraan) ini untuk kami, padahal sebelumnya kami tidak mampu menguasainya, dan sesungguhnya kepada Tuhan kamilah kami akan kembali.”</p>
    </div>
  </div>
</body>
</html>
