<?php


function pembayaran()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT COUNT(*) as total FROM pembayaran INNER JOIN warga ON warga.id_warga = pembayaran.id_warga WHERE warga.id_user = $_SESSION[id_user]")->fetch_assoc();
    return $item;
}