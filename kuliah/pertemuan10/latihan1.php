<?php
// koneksi ke database & pilih database
$conn = mysqli_connect('localhost', 'root', '', 'pw_2020');


// query isi tabel mahasiswa
$result = mysqli_query($conn, "SELECT * FROM mahasiswa");


// ubah data ke dalam array
// $row = mysqli_fetch_row($result); // array numerik
// $row = mysqli_fetch_array($result); // keduanya
// $row = mysqli_fetch_assoc($result); // array associative
$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
  $rows[] = $row;
}


// tampung ke variabel mahasiswa
$mahasiswa = $rows;


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Mahasiswa</title>
</head>

<body>
  <h3>Daftar Mahasiswa</h3>

  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Gambar</th>
      <th>NPM</th>
      <th>Nama</th>
      <th>Email</th>
      <th>Jurusan</th>
      <th>Aksi</th>
    </tr>
    <?php $i = 1;
    foreach ($mahasiswa as $mhs) : ?>
      <tr>
        <td><?= $i++; ?></td>
        <td><img src="img/<?= $mhs["gambar"]; ?>"></td>
        <td><?= $mhs["npm"]; ?></td>
        <td><?= $mhs["nama"]; ?></td>
        <td><?= $mhs["email"]; ?></td>
        <td><?= $mhs["jurusan"]; ?></td>
        <td>
          <a href="#">Ubah</a> |
          <a href="#">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>