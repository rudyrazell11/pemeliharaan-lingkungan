<?php

function getDetail($id_user)
{
    global $koneksi;
    $item = $koneksi->query("SELECT usr.*, wr.jenis_kelamin, wr.nomor_telepon, wr.nomor_whatsapp, wr.tanggal_lahir, wr.id_blok, blok.nama_blok, komplek.nama_komplek FROM user usr INNER JOIN warga wr ON wr.id_user=usr.id_user INNER JOIN blok ON blok.id_blok=wr.id_blok INNER JOIN komplek ON komplek.id_komplek=blok.id_komplek WHERE usr.id_user=$id_user")->fetch_assoc();
    return $item;
}

function updateProfile($post)
{
    global $koneksi;

    // update user
    if ($post['password']) {

        $pw_hash = password_hash($post['password'], PASSWORD_BCRYPT);
        $user = $koneksi->query("UPDATE `user` SET `password` = '$pw_hash' WHERE `user`.`id_user` = $_SESSION[id_user]");
    } else {
        $passwordUpdate = NULL;
    }

    // update warga
    $jenis_kelamin = htmlspecialchars($post['jenis_kelamin']);
    $tanggal_lahir = htmlspecialchars($post['tanggal_lahir']);
    $nomor_telepon = htmlspecialchars($post['nomor_telepon']);
    $nomor_whatsapp = htmlspecialchars($post['nomor_whatsapp']);

    $koneksi->query("UPDATE `warga` SET `jenis_kelamin` = '$jenis_kelamin', `tanggal_lahir` = '$tanggal_lahir', `nomor_telepon` = '$nomor_telepon', `nomor_whatsapp` = '$nomor_whatsapp' WHERE `warga`.`id_user` = $_SESSION[id_user]");

    return true;
}
