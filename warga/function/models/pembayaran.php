<?php

function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM pembayaran pmb INNER JOIN warga ON pmb.id_warga=warga.id_warga INNER JOIN periode_iuran pi ON pi.id_periode_iuran=pmb.id_periode_iuran INNER JOIN jenis_iuran ji ON pi.id_jenis_iuran=ji.id_jenis_iuran WHERE warga.id_user = $_SESSION[id_user] AND pmb.status = 'Sudah Bayar'  ORDER BY pmb.id_pembayaran DESC ");
    $data = [];
    while($row = $items->fetch_assoc()){
        $data[] = $row;
    }

    return $data;
}

function getTagihan()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM pembayaran pmb INNER JOIN warga ON pmb.id_warga=warga.id_warga INNER JOIN periode_iuran pi ON pi.id_periode_iuran=pmb.id_periode_iuran INNER JOIN jenis_iuran ji ON pi.id_jenis_iuran=ji.id_jenis_iuran WHERE warga.id_user = $_SESSION[id_user] AND pmb.status IN ('Belum Bayar','Gagal','Proses')  ORDER BY pmb.id_pembayaran DESC ");
    $data = [];
    while($row = $items->fetch_assoc()){
        $data[] = $row;
    }

    return $data;
}


function getById($id_pembayaran)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM pembayaran pmb INNER JOIN warga ON pmb.id_warga=warga.id_warga INNER JOIN periode_iuran pi ON pi.id_periode_iuran=pmb.id_periode_iuran INNER JOIN jenis_iuran ji ON pi.id_jenis_iuran=ji.id_jenis_iuran INNER JOIN blok bl ON warga.id_blok=bl.id_blok INNER JOIN komplek kom ON kom.id_komplek=bl.id_komplek INNER JOIN metode_pembayaran pem ON pem.id_metode_pembayaran=pmb.id_metode_pembayaran WHERE id_pembayaran=$id_pembayaran AND warga.id_user = $_SESSION[id_user]")->fetch_assoc();
    return $item;
}
