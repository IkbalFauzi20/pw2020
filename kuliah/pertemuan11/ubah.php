<?php
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
        <label>
          Gambar
          <input type="text" name="gambar" placeholder="gambar" required value="<?= $mhs["gambar"]; ?>">
        </label>
      </li>
      <li>
        <button type="submit" name="ubah">Ubah Data!</button>
      </li>
    </ul>
  </form>

</body>

</html>