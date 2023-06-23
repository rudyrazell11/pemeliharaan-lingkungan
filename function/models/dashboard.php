<?php


function pembayaran()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT COUNT(*) as total FROM pembayaran")->fetch_assoc();
    return $item;
}


function warga()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT COUNT(*) as total FROM warga")->fetch_assoc();
    return $item;
}

function jenis_iuran()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT COUNT(*) as total FROM jenis_iuran")->fetch_assoc();
    return $item;
}

function periode_iuran()
{
    global  $koneksi;
    $item = $koneksi->query("SELECT COUNT(*) as total FROM periode_iuran")->fetch_assoc();
    return $item;
}

function getPembayaranLatest()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM pembayaran pmb INNER JOIN warga warga ON pmb.id_warga=warga.id_warga INNER JOIN periode_iuran pi ON pi.id_periode_iuran=pmb.id_periode_iuran INNER JOIN jenis_iuran ji ON pi.id_jenis_iuran=ji.id_jenis_iuran ORDER BY pmb.id_pembayaran DESC LIMIT 10");
    $data = [];
    while($row = $items->fetch_assoc()){
        $data[] = $row;
    }

    return $data;
}