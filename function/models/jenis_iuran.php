<?php



function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM jenis_iuran");
    $data = [];
    while($row = $items->fetch_assoc()){
        $data[] = $row;
    }

    return $data;
}

function tambahData($post)
{
    global $koneksi;
    $nama_jenis = htmlspecialchars($post['nama_jenis']);
    $insert = $koneksi->query("INSERT INTO `jenis_iuran` (`id_jenis_iuran`, `nama_jenis`) VALUES (NULL, '$nama_jenis')");
    if($insert)
    {
        $insertId = $koneksi->insert_id;
    }else{
        $insertId = false;
    }

    return $insertId;
}   

function getById($id_jenis_iuran)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM jenis_iuran WHERE id_jenis_iuran=$id_jenis_iuran")->fetch_assoc();
    return $item;
}

function updateData($post)
{
    global $koneksi;
    $id_jenis_iuran = htmlspecialchars($post['id_jenis_iuran']);
    $nama_jenis = htmlspecialchars($post['nama_jenis']);
    $update = $koneksi->query("UPDATE `jenis_iuran` SET `nama_jenis` = '$nama_jenis' WHERE `jenis_iuran`.`id_jenis_iuran` = $id_jenis_iuran;");

    if($update)
    {
        return true;
    }else{
        return false;
    }
}   

function deleteData($id_jenis_iuran)
{
    global $koneksi;
    $item = $koneksi->query("DELETE FROM jenis_iuran WHERE id_jenis_iuran=$id_jenis_iuran");
}