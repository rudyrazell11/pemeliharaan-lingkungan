<?php



function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM metode_pembayaran");
    $data = [];
    while($row = $items->fetch_assoc()){
        $data[] = $row;
    }

    return $data;
}

function tambahData($post)
{
    global $koneksi;
    $nama = htmlspecialchars($post['nama']);
    $nomor = htmlspecialchars($post['nomor']);
    $pemilik = htmlspecialchars($post['pemilik']);
    $insert = $koneksi->query("INSERT INTO `metode_pembayaran` (`id_metode_pembayaran`, `nama`, `nomor`, `pemilik`) VALUES (NULL, '$nama', '$nomor', '$pemilik')");
    if($insert)
    {
        $insertId = $koneksi->insert_id;
    }else{
        $insertId = false;
    }

    return $insertId;
}   

function getById($id_metode_pembayaran)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM metode_pembayaran WHERE id_metode_pembayaran=$id_metode_pembayaran")->fetch_assoc();
    return $item;
}

function updateData($post)
{
    global $koneksi;
    $id_metode_pembayaran = htmlspecialchars($post['id_metode_pembayaran']);
    $nama = htmlspecialchars($post['nama']);
    $nomor = htmlspecialchars($post['nomor']);
    $pemilik = htmlspecialchars($post['pemilik']);
    $update = $koneksi->query("UPDATE `metode_pembayaran` SET `nama` = '$nama', `nomor` = '$nomor', `pemilik` = '$pemilik' WHERE `metode_pembayaran`.`id_metode_pembayaran` = $id_metode_pembayaran;");

    if($update)
    {
        return true;
    }else{
        return false;
    }
}   

function deleteData($id_metode_pembayaran)
{
    global $koneksi;
    $item = $koneksi->query("DELETE FROM metode_pembayaran WHERE id_metode_pembayaran=$id_metode_pembayaran");
}