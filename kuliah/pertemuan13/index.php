<?php
session_start();

// apakah user sudah login atau belum
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}


require 'functions.php';
// query isi tabel mahasiswa
// tampung ke variabel mahasiswa
$mahasiswa = query("SELECT * FROM mahasiswa");


// tombol cari ditekan
if (isset($_POST["cari"])) {
  $mahasiswa = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Mahasiswa</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@200;300;400;500;600;700;800&family=Geologica:wght@100;300;400;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<!-- Feather Icons -->
<script src="https://unpkg.com/feather-icons"></script>

<!-- My Style -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

<!-- Navbar Start -->
<nav class="navbar">
  <a href="#" class="navbar-logo">Data <span>Mahasiswa</span></a>
  <div class="navbar-nav">
    <a href="#">Home</a>
    <a href="#about">About</a>
    <a href="#data">Daftar Mahasiswa</a>
    <a href="#tambah.php">Tambah Data</a>
    <a href="#contact">Contact</a>
  </div>
  <div class="navbar-extra">
    <a href="logout.php"><i data-feather="log-out"></i></a>
    <a href="#" id="hamburger-menu"><i data-feather="menu"></i></i></a>
  </div>
</nav>
<!-- Navbar End -->
  <a href="tambah.php">Tambah Data Mahasiswa</a>
  <br><br>
  <form action="" method="post">
    <input type="text" name="keyword" placeholder="Masukan keyword pencarian..." autocomplete="off" autofocus class="keyword">
    <button type="submit" name="cari" class="tombol-cari">Cari</button>
  </form>

  <div class="container">
    <table border="1" cellpadding="10" cellspacing="0">
      <tr>
        <th>No</th>
        <th>Gambar</th>
        <th>Nama</th>
      </tr>

      <?php if (empty($mahasiswa)) : ?>
        <tr>
          <td colspan="4">
            <p>Data tidak ditemukan</p>
          </td>
        </tr>
      <?php endif; ?>

      <?php $i = 1;
      foreach ($mahasiswa as $mhs) : ?>
        <tr>
          <td><?= $i++; ?></td>
          <td><img src="img/<?= $mhs["gambar"]; ?>" width="100px"></td>
          <td><?= $mhs["nama"]; ?></td>
          <td>
            <a href="detail.php?id=<?= $mhs['id']; ?>">Lihat Detail</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <!-- Feather Icons -->
  <script>
      feather.replace()
    </script>

    <!-- My Javascript -->
    <script src="js/script.js"></script>
</body>

</html>