<?php



function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM blok bl INNER JOIN komplek km ON bl.id_komplek=km.id_komplek");
    $data = [];
    while($row = $items->fetch_assoc()){
        $data[] = $row;
    }

    return $data;
}

function tambahData($post)
{
    global $koneksi;
    $id_komplek = htmlspecialchars($post['id_komplek']);
    $nama_blok = htmlspecialchars($post['nama_blok']);
    $insert = $koneksi->query("INSERT INTO `blok` (`id_blok`, `id_komplek`, `nama_blok`) VALUES (NULL, '$id_komplek', '$nama_blok')");
    if($insert)
    {
        $insertId = $koneksi->insert_id;
    }else{
        $insertId = false;
    }

    return $insertId;
}   

function getById($id_blok)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM blok WHERE id_blok=$id_blok")->fetch_assoc();
    return $item;
}

function updateData($post)
{
    global $koneksi;
    $id_blok = htmlspecialchars($post['id_blok']);
    $nama_blok = htmlspecialchars($post['nama_blok']);
    $id_komplek = htmlspecialchars($post['id_komplek']);
    $update = $koneksi->query("UPDATE `blok` SET `nama_blok` = '$nama_blok', `id_komplek` = '$id_komplek' WHERE `blok`.`id_blok` = $id_blok;");

    if($update)
    {
        return true;
    }else{
        return false;
    }
}   

function deleteData($id_blok)
{
    global $koneksi;
    $item = $koneksi->query("DELETE FROM blok WHERE id_blok=$id_blok");
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

function getByKomplek($id_komplek)
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM blok bl INNER JOIN komplek km ON bl.id_komplek=km.id_komplek WHERE bl.id_komplek=$id_komplek");
    $data = [];
    while($row = $items->fetch_assoc()){
        $data[] = $row;
    }

    return $data;
}