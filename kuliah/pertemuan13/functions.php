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
  //$gambar = htmlspecialchars($data["gambar"]);

  if (empty($nama) || empty($npm) || empty($email) || empty($jurusan)) {
    echo "<script>
          alert('Pastikan semua data telah di isi');
          document.location.href = 'tambah.php';
          </script>";
    return false;
  }

  // upload gambar
  $gambar = upload();
  if (!$gambar) {
    return false;
  }

  $query = "INSERT INTO 
  mahasiswa
  VALUES
  (null,'$nama','$npm','$email','$jurusan','$gambar')
  ";
  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}

function upload()
{
  $namaFile = $_FILES['gambar']['name'];
  $tipeFile = $_FILES['gambar']['type'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  // cek apakah tidak ada gambar yg diupload
  if ($error === 4) {
    echo "<script>
    alert('pilih gambar terlebih dahulu');
    </script>";
    return false;
  }

  // cek ekstensi gambar
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>
    alert('yang anda upload bukan gambar');
    </script>";
    return false;
  }

  // cek tipe file
  if ($tipeFile != 'image/jpeg' && $tipeFile != 'image/png') {
    echo "<script>
    alert('yang anda upload bukan gambar');
    </script>";
    return false;
  }

  // cek jika ukurannya terlalu besar
  if ($ukuranFile > 5000000) {
    echo "<script>
    alert('Ukuran gambar terlalu besar');
    </script>";
    return false;
  }

  //gambar siap diupload
  // generate nama gambar baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiGambar;

  move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
  return $namaFileBaru;
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

function cari($keyword)
{
  $conn = koneksi();
  $query = "SELECT * FROM mahasiswa
  WHERE
  nama LIKE '%$keyword%' OR
  npm LIKE '%$keyword%' OR 
  email LIKE '%$keyword%' OR
  jurusan LIKE '%$keyword%' 
  ";
  $result = mysqli_query($conn, $query);

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function login($data)
{
  $conn = koneksi();

  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);

  // cek dulu usernamenya
  if ($user = query("SELECT * FROM user WHERE username = '$username'")) {
    // cek password
    if (password_verify($password, $user['password'])) {
      // set session
      $_SESSION['login'] = true;

      header("Location: index.php");
      exit;
    }
  }
  return [
    'error' => true,
    'pesan' => 'Username / Password Salah!'
  ];
}

function registrasi($data)
{
  $conn = koneksi();
  $username = htmlspecialchars(strtolower(stripslashes($data["username"])));
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password2 = mysqli_real_escape_string($conn, $data["password2"]);


  // jika username dan password yg diinput kosong
  if (empty($username) || empty($password) || empty($password2)) {
    echo "<script>
          alert('Username dan Password tidak boleh kosong!');
          document.location.href = 'registrasi.php';
          </script>";
    return false;
  }

  // cek username sudah ada atau belum
  if (query("SELECT * FROM user WHERE username = '$username'")) {
    echo "<script>
    alert('Username sudah terdaftar');
    document.location.href = 'registrasi.php';
    </script>";

    return false;
  }

  // cek konfirmasi password
  if ($password !== $password2) {
    echo "<script>
    alert('Konfirmasi password tidak sesuai');
    document.location.href = 'registrasi.php';
    </script>";
    return false;
  }

  // jika password lebih kecil dari 5 digit
  if (strlen($password) < 5) {
    echo "<script>
    alert('Password terlalu pendek');
    document.location.href = 'registrasi.php';
    </script>";
    return false;
  }

  // enkripsi password
  $password_baru = password_hash($password, PASSWORD_DEFAULT);

  // tambahkan user baru ke database
  mysqli_query($conn, "INSERT INTO user
  VALUES
  (null, '$username', '$password_baru') 
  ") or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
