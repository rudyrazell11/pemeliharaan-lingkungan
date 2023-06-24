<?php


function pembayaran()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT COUNT(*) as total FROM pembayaran INNER JOIN warga ON warga.id_warga = pembayaran.id_warga WHERE warga.id_user = $_SESSION[id_user]")->fetch_assoc();
    return $item;
}

function getDetail($id_user)
{
    global $koneksi;
    $item = $koneksi->query("SELECT usr.*, wr.jenis_kelamin, wr.nomor_telepon, wr.nomor_whatsapp, wr.tanggal_lahir, wr.id_blok, wr.id_warga, blok.nama_blok, komplek.nama_komplek,wr.nama_warga FROM user usr INNER JOIN warga wr ON wr.id_user=usr.id_user INNER JOIN blok ON blok.id_blok=wr.id_blok INNER JOIN komplek ON komplek.id_komplek=blok.id_komplek WHERE usr.id_user=$id_user")->fetch_assoc();
    return $item;
}

function tagihan()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT COUNT(*) as total FROM periode_iuran")->fetch_assoc();
    return $item;
}

function jenis_iuran()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT COUNT(*) as total FROM jenis_iuran")->fetch_assoc();
    return $item;
}
