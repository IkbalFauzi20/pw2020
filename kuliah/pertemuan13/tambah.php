<?php
session_start();

// apakah user sudah login atau belum
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

// cek apakah tombol tambah sudah ditekan atau belum
if (isset($_POST["tambah"])) {
  if (tambah($_POST) > 0) {
    echo "<script>
        alert('Data Berhasil Ditambahkan');
        document.location.href = 'index.php';
        </script>";
  } else {
    echo "alert('Data Gagal Ditambahkan!')";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Mahasiswa</title>
</head>

<body>
  <h3>Form Tambah Data Mahasiswa</h3>
  <form action="" method="post" enctype="multipart/form-data">
    <ul>
      <li>
        <label>
          Nama
          <input type="text" name="nama" placeholder="nama" required autofocus>
        </label>
      </li>
      <li>
        <label>
          NPM
          <input type="text" name="npm" placeholder="npm" required>
        </label>
      </li>
      <li>
        <label>
          Email
          <input type="text" name="email" placeholder="email" required>
        </label>
      </li>
      <li>
        <label>
          Jurusan
          <input type="text" name="jurusan" placeholder="jurusan" required>
        </label>
      </li>
      <li>
        <label>
          Gambar
          <input type="file" name="gambar" class="gambar" onchange="imagePreview()" />
        </label>
        <img src="img/no_image.png" width="120px" style="display: block;" class="img-preview">
      </li>
      <li>
        <button type="submit" name="tambah">Tambah Data!</button>
      </li>
    </ul>
  </form>
  <script src="js/script.js"></script>
</body>

</html>