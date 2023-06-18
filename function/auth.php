<?php
require_once 'config/koneksi.php';

function process_login($post)
{
    if (isset($post['login'])) {
     
        // Melindungi dari SQL injection
        $email = mysqli_real_escape_string($koneksi, $email);
        $password = mysqli_real_escape_string($koneksi, $password);

        // Query untuk memeriksa kecocokan email dan password
        $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
        $result = mysqli_query($koneksi, $query);

        // Memeriksa jumlah baris yang ditemukan
        $count = mysqli_num_rows($result);

        // Jika email dan password cocok, set session dan kembalikan true
        if ($count == 1) {
            var_dump($count);die;
            session_start();
            $_SESSION['email'] = $email;
            return true;
        } else {
            // Jika email dan password tidak cocok, kembalikan false
            return false;
        }
    }
}
