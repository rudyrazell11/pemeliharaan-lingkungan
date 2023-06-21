<?php


function process_login($post)
{
    global $koneksi;

    // Melindungi dari SQL injection
    $email = htmlspecialchars($post['email']);
    $password = htmlspecialchars($post['password']);

    $result = $koneksi->query("SELECT * FROM user WHERE email='$email'");
    // Memeriksa jumlah baris yang ditemukan
    $user = $result->fetch_object();
    // Jika email dan password cocok, set session dan kembalikan true
    if ($user) {
        
        // cek password
        if (password_verify($password,$user->password)) {
            session_start();
            $_SESSION['id_user'] = $user->id_user;
            $_SESSION['nama'] = $user->nama;
            $_SESSION['email'] = $user->email;
            $_SESSION['level'] = $user->level;
            return true;
        }else{
            return false;
        }
    } else {
        // Jika email dan password tidak cocok, kembalikan false
        return false;
    }
}
