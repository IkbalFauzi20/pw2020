<?php
session_start();

// apakah user sudah login atau belum
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

// cek jika masuk ke halaman ubah tanpa mengirim id
if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}
// ambil id di url
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id");

if (isset($_POST["ubah"])) {
  if (ubah($_POST) > 0) {
    echo "<script>
        alert('Data Berhasil Diubah');
        document.location.href = 'index.php';
        </script>";
  } else {
    echo "alert('Data Gagal Diubah!')";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Data Mahasiswa</title>
</head>

<body>
  <h3>Form Ubah Data Mahasiswa</h3>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
    <ul>
      <li>
        <label>
          Nama
          <input type="text" name="nama" placeholder="nama" required autofocus value="<?= $mhs["nama"]; ?>">
        </label>
      </li>
      <li>
        <label>
          NPM
          <input type="text" name="npm" placeholder="npm" required value="<?= $mhs["npm"]; ?>">
        </label>
      </li>
      <li>
        <label>
          Email
          <input type="text" name="email" placeholder="email" required value="<?= $mhs["email"]; ?>">
        </label>
      </li>
      <li>
        <label>
          Jurusan
          <input type="text" name="jurusan" placeholder="jurusan" required value="<?= $mhs["jurusan"]; ?>">
        </label>
      </li>
      <li>
        <input type="hidden" name="gambar_lama" value="<?= $mhs["gambar"]; ?>">
        <label>
          Gambar
          <input type="file" name="gambar" class="gambar" onchange="imagePreview()" />
        </label>
        <img src="img/<?= $mhs["gambar"]; ?>" width="120px" style="display: block;" class="img-preview">
      </li>
      <li>
        <button type="submit" name="ubah">Ubah Data!</button>
      </li>
    </ul>
  </form>
  <script src="js/script.js"></script>
</body>

</html>