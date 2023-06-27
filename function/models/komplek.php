<?php

function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM komplek");
    $data = [];
    while($row = $items->fetch_assoc()){
        $data[] = $row;
    }

    return $data;
}

function tambahData($post)
{
    global $koneksi;
    $nama_komplek = htmlspecialchars($post['nama_komplek']);
    $insert = $koneksi->query("INSERT INTO `komplek` (`id_komplek`, `nama_komplek`) VALUES (NULL, '$nama_komplek')");
    if($insert)
    {
        $insertId = $koneksi->insert_id;
    }else{
        $insertId = false;
    }

    return $insertId;
}   

function getById($id_komplek)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM komplek WHERE id_komplek=$id_komplek")->fetch_assoc();
    return $item;
}

function updateData($post)
{
    global $koneksi;
    $id_komplek = htmlspecialchars($post['id_komplek']);
    $nama_komplek = htmlspecialchars($post['nama_komplek']);
    $update = $koneksi->query("UPDATE `komplek` SET `nama_komplek` = '$nama_komplek' WHERE `komplek`.`id_komplek` = $id_komplek;");

    if($update)
    {
        return true;
    }else{
        return false;
    }
}   

function deleteData($id_komplek)
{
    global $koneksi;
    $item = $koneksi->query("DELETE FROM komplek WHERE id_komplek=$id_komplek");
}

function validasiTambah($post)
{
    if(!$post['nama_komplek'])
    {
        redirectUrl(BASE_URL . '/main.php?page=komplek-create&status=error&message=Nama Komplek tidak boleh kosong.');
        exit;
    }
}

function validasiEdit($post)
{
    if(!$post['nama_komplek'])
    {
        redirectUrl(BASE_URL . '/main.php?page=komplek-edit&id_komplek='.$post['id_komplek'].'&status=error&message=Nama Komplek tidak boleh kosong.');
        exit;
    }
}