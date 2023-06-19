<?php


$servername = 'localhost';
$username = 'pmauser';
$password = 'pmapass';
$dbname = 'pemeliharaan_lingkungan';

// Buat objek mysqli
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Cek apakah terjadi error pada koneksi
if ($koneksi->connect_error) {
    die('Koneksi MySQL error: ' . $koneksi->connect_error);
}

// Tutup koneksi
// $koneksi->close();

?>