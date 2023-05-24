<?php
require 'functions.php';
// ambil id di url
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Mahasiswa</title>
</head>

<body>
  <h3>Detail Mahasiswa</h3>
  <ul>
    <li><img src="img/<?= $mhs['gambar']; ?>" alt=""></li>
    <li>Nama : <?= $mhs['nama']; ?></li>
    <li>NPM : <?= $mhs['npm']; ?></li>
    <li>Email : <?= $mhs['email']; ?></li>
    <li>Jurusan : <?= $mhs['jurusan']; ?></li>
    <li><a href="ubah.php?id=<?= $mhs['id']; ?>">Ubah</a>|<a href="hapus.php?id=<?= $mhs['id']; ?>" onclick="return confirm('Apakah anda yakin?');">Hapus</a></li>
    <li><a href="index.php">Kembali ke Daftar Mahasiswa</a></li>
  </ul>
</body>

</html>