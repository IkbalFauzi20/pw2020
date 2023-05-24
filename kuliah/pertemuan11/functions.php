<?php

function koneksi()
{
  // koneksi ke database & pilih database
  return mysqli_connect('localhost', 'root', '', 'pw_2020');
}

function query($query)
{
  $conn = koneksi();

  $result = mysqli_query($conn, $query);

  //jika datanya cuma 1
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }

  // ubah data ke dalam array
  // $row = mysqli_fetch_row($result); // array numerik
  // $row = mysqli_fetch_array($result); // keduanya
  // $row = mysqli_fetch_assoc($result); // array associative
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function tambah($data)
{
  $conn = koneksi();
  $nama = htmlspecialchars($data["nama"]);
  $npm = htmlspecialchars($data["npm"]);
  $email = htmlspecialchars($data["email"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $gambar = htmlspecialchars($data["gambar"]);

  $query = "INSERT INTO 
  mahasiswa
  VALUES
  (null,'$nama','$npm','$email','$jurusan','$gambar')
  ";
  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}

function hapus($id)
{
  $conn = koneksi();
  $query = "DELETE FROM mahasiswa WHERE id = $id";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function ubah($data)
{
  $conn = koneksi();
  $id = $data["id"];
  $nama = htmlspecialchars($data["nama"]);
  $npm = htmlspecialchars($data["npm"]);
  $email = htmlspecialchars($data["email"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $gambar = htmlspecialchars($data["gambar"]);

  $query = "UPDATE mahasiswa SET
  
    nama = '$nama',
    npm = '$npm',
    email = '$email',
    jurusan = '$jurusan',
    gambar = '$gambar'
    WHERE id = $id
  ";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
