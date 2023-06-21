<?php



function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM user");
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
    $nominal = htmlspecialchars($post['nominal']);
    $insert = $koneksi->query("INSERT INTO `user` (`id_user`, `nama_jenis`, `nominal`) VALUES (NULL, '$nama_jenis',$nominal)");
    if($insert)
    {
        $insertId = $koneksi->insert_id;
    }else{
        $insertId = false;
    }

    return $insertId;
}   

function getById($id_user)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM user WHERE id_user=$id_user")->fetch_assoc();
    return $item;
}

function updateData($post)
{
    global $koneksi;
    $id_user = htmlspecialchars($post['id_user']);
    $nama_jenis = htmlspecialchars($post['nama_jenis']);
    $nominal = htmlspecialchars($post['nominal']);
    $update = $koneksi->query("UPDATE `user` SET `nama_jenis` = '$nama_jenis', `nominal` = $nominal WHERE `user`.`id_user` = $id_user;");

    if($update)
    {
        return true;
    }else{
        return false;
    }
}   

function deleteData($id_user)
{
    global $koneksi;
    $item = $koneksi->query("DELETE FROM user WHERE id_user=$id_user");
}

function getKomplek()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM komplek");
    $data = [];
    while($row = $items->fetch_assoc()){
        $data[] = $row;
    }

    return $data;
}