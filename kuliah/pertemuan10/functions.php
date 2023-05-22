<?php

function koneksi()
{
  // koneksi ke database & pilih database
  return mysqli_connect('localhost', 'root', '', 'pw_2020');
}

function query($query)
{
  $result = mysqli_query(koneksi(), $query);

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
