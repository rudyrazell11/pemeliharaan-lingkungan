<?php



function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM periode_iuran pi INNER JOIN jenis_iuran ji ON pi.id_jenis_iuran=ji.id_jenis_iuran");
    $data = [];
    while($row = $items->fetch_assoc()){
        $data[] = $row;
    }

    return $data;
}

function tambahData($post)
{
    global $koneksi;
    $id_jenis_iuran = htmlspecialchars($post['id_jenis_iuran']);
    $bulan = htmlspecialchars($post['bulan']);
    $tahun = htmlspecialchars($post['tahun']);
    $insert = $koneksi->query("INSERT INTO `periode_iuran` (`id_periode_iuran`, `id_jenis_iuran`, `bulan`, `tahun`) VALUES (NULL, '$id_jenis_iuran', '$bulan', '$tahun')");
    if($insert)
    {
        $insertId = $koneksi->insert_id;
    }else{
        $insertId = false;
    }

    return $insertId;
}   

function getById($id_periode_iuran)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM periode_iuran WHERE id_periode_iuran=$id_periode_iuran")->fetch_assoc();
    return $item;
}

function updateData($post)
{
    global $koneksi;
    $id_periode_iuran = htmlspecialchars($post['id_periode_iuran']);
    $bulan = htmlspecialchars($post['bulan']);
    $tahun = htmlspecialchars($post['tahun']);
    $id_jenis_iuran = htmlspecialchars($post['id_jenis_iuran']);
    $update = $koneksi->query("UPDATE `periode_iuran` SET `bulan` = '$bulan', `tahun` = '$tahun', `id_jenis_iuran` = '$id_jenis_iuran' WHERE `periode_iuran`.`id_periode_iuran` = $id_periode_iuran;");

    if($update)
    {
        return true;
    }else{
        return false;
    }
}   

function deleteData($id_periode_iuran)
{
    global $koneksi;
    $item = $koneksi->query("DELETE FROM periode_iuran WHERE id_periode_iuran=$id_periode_iuran");
}

function getJenisIuran()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM jenis_iuran");
    $data = [];
    while($row = $items->fetch_assoc()){
        $data[] = $row;
    }

    return $data;
}