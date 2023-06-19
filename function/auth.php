<?php


function process_login($post)
{
    global $koneksi;

    // Melindungi dari SQL injection
    $email = htmlspecialchars($post['email']);
    $password = htmlspecialchars($post['password']);

    $result = $koneksi->query("SELECT * FROM admin WHERE email='$email'");

    // Memeriksa jumlah baris yang ditemukan
    $admin = $result->fetch_object();
    // Jika email dan password cocok, set session dan kembalikan true
    if ($admin) {

     
        // cek password
        if (password_verify($password,$admin->password)) {
            session_start();
            $_SESSION['id_admin'] = $admin->id_admin;
            $_SESSION['nama'] = $admin->nama;
            $_SESSION['email'] = $email;
            $_SESSION['level'] = 'admin';
            return true;
        }else{
            return false;
        }
    } else {
        // Jika email dan password tidak cocok, kembalikan false
        return false;
    }
}
