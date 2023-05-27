<?php
session_start();

// cek apakah sudah login atau belum
if (isset($_SESSION['login'])) {
  header("Locaition: index.php");
  exit;
}

require 'functions.php';

// ketika tombol login ditekan
if (isset($_POST['login'])) {
  $login = login($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login</title>
</head>

<body>
  <h3>Form Login</h3>
  <?php if (isset($login['error'])) : ?>
    <p><?= $login['pesan']; ?></p>
  <?php endif; ?>
  <form action="" method="post">
    <ul>
      <li>
        <label>
          Username
          <input type="text" name="username" autofocus autocomplete="off" required>
        </label>
      </li>
      <li>
        <label>
          Password
          <input type="password" name="password" required>
        </label>
      </li>
      <li>
        <label>
          Remember me
          <input type="checkbox" name="remember">
        </label>
      </li>
      <li>
        <button type="submit" name="login">Login</button>
      </li>
      <a href="registrasi.php">Tambah User Baru</a>
    </ul>
  </form>
</body>

</html>