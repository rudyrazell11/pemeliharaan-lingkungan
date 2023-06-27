<?php



function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM pembayaran pmb INNER JOIN warga warga ON pmb.id_warga=warga.id_warga INNER JOIN periode_iuran pi ON pi.id_periode_iuran=pmb.id_periode_iuran INNER JOIN jenis_iuran ji ON pi.id_jenis_iuran=ji.id_jenis_iuran ORDER BY pmb.id_pembayaran DESC");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function tambahData($post)
{
    global $koneksi;
    $id_warga = htmlspecialchars($post['id_warga']);
    $id_periode_iuran = htmlspecialchars($post['id_periode_iuran']);
    $id_metode_pembayaran = htmlspecialchars($post['id_metode_pembayaran']);
    $status = htmlspecialchars($post['status']);
    $kode_pembayaran = getKodePembayaranBaru();
    $nominal = getPeriodeIuran($id_periode_iuran)['nominal'];

    $insert = $koneksi->query("INSERT INTO `pembayaran` (`id_pembayaran`, `kode_pembayaran`, `id_warga`, `id_periode_iuran`, `id_metode_pembayaran`, `nominal`, `status`, `tanggal`) VALUES (NULL, '$kode_pembayaran', $id_warga, $id_periode_iuran, $id_metode_pembayaran, $nominal, '$status', CURRENT_TIMESTAMP)");
    if ($insert) {
        $insertId = $koneksi->insert_id;
    } else {
        $insertId = false;
    }

    return $insertId;
}

function getPeriodeIuran($id_periode_iuran)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM periode_iuran WHERE id_periode_iuran=$id_periode_iuran")->fetch_assoc();
    return $item;
}

function getKodePembayaranBaru()
{
    return time();
}

function getById($id_pembayaran)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM pembayaran pmb INNER JOIN warga ON pmb.id_warga=warga.id_warga INNER JOIN periode_iuran pi ON pi.id_periode_iuran=pmb.id_periode_iuran INNER JOIN jenis_iuran ji ON pi.id_jenis_iuran=ji.id_jenis_iuran INNER JOIN blok bl ON warga.id_blok=bl.id_blok INNER JOIN komplek kom ON kom.id_komplek=bl.id_komplek WHERE id_pembayaran=$id_pembayaran")->fetch_assoc();
    return $item;
}

function updateData($post)
{
    global $koneksi;
    $id_pembayaran = htmlspecialchars($post['id_pembayaran']);
    $id_metode_pembayaran = htmlspecialchars($post['id_metode_pembayaran']);
    $status = htmlspecialchars($post['status']);
    $update = $koneksi->query("UPDATE `pembayaran` SET `id_metode_pembayaran` = '$id_metode_pembayaran', `status` = '$status' WHERE `pembayaran`.`id_pembayaran` = $id_pembayaran;");

    if ($update) {
        return true;
    } else {
        return false;
    }
}

function deleteData($id_pembayaran)
{
    global $koneksi;
    $item = $koneksi->query("DELETE FROM pembayaran WHERE id_pembayaran=$id_pembayaran");
}

function getWarga()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM warga");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function getMetodePembayaran()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM metode_pembayaran");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function getJenisIuran()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM jenis_iuran");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function getPeriodeIuranByJenisIuran($id_jenis_iuran)
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM periode_iuran pi INNER JOIN jenis_iuran ji ON pi.id_jenis_iuran=ji.id_jenis_iuran WHERE pi.id_jenis_iuran=$id_jenis_iuran");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function filter($post)
{
    global $koneksi;
    $id_periode_iuran = $post['id_periode_iuran'];
    $status = $post['status'];

    $items = $koneksi->query("SELECT * FROM pembayaran pmb INNER JOIN warga warga ON pmb.id_warga=warga.id_warga INNER JOIN periode_iuran pi ON pi.id_periode_iuran=pmb.id_periode_iuran INNER JOIN jenis_iuran ji ON pi.id_jenis_iuran=ji.id_jenis_iuran WHERE pmb.id_periode_iuran = $id_periode_iuran AND pmb.status='$status' ORDER BY pmb.id_pembayaran DESC");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function getPembayaranFilter($filter)
{
    global $koneksi;
    $id_jenis_iuran = $filter['id_jenis_iuran'];
    $id_periode_iuran = $filter['id_periode_iuran'];
    $status = $filter['status'];

    if ($id_periode_iuran) {
        $periode_iuran = 'WHERE pi.id_periode_iuran=' . $id_periode_iuran;
    }else{
        $periode_iuran = "";
    }

    if ($status) {
        if($id_jenis_iuran)
        {
            $statuspmb = 'AND pmb.status=' . "'" . $status . "'";
        }else{
            $statuspmb = 'WHERE pmb.status=' . "'" . $status . "'";
        }
    }else{
        $statuspmb = "";
    }

    $items = $koneksi->query("SELECT * FROM pembayaran pmb INNER JOIN warga warga ON pmb.id_warga=warga.id_warga INNER JOIN periode_iuran pi ON pi.id_periode_iuran=pmb.id_periode_iuran INNER JOIN jenis_iuran ji ON pi.id_jenis_iuran=ji.id_jenis_iuran $periode_iuran $statuspmb ORDER BY pmb.id_pembayaran DESC");
    $data = [];
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function getIuranById($id_jenis_iuran)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM jenis_iuran WHERE id_jenis_iuran=$id_jenis_iuran")->fetch_assoc();
    return $item;
}

function getPeriodeById($id_periode_iuran)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM periode_iuran WHERE id_periode_iuran=$id_periode_iuran")->fetch_assoc();
    return $item;
}

function validasiTambah($post)
{
    if(!$post['id_warga'] || !$post['id_periode_iuran'] || !$post['id_metode_pembayaran'] || !$post['status'] )
    {
        redirectUrl(BASE_URL . '/main.php?page=pembayaran-create&status=error&message=Warga, Periode Iuran, Metode Pembayaran tidak boleh kosong.');
        exit;
    }
}

function validasiEdit($post)
{
    if(!$post['id_metode_pembayaran'] || !$post['status'])
    {
        redirectUrl(BASE_URL . '/main.php?page=pembayaran-edit&id_pembayaran='.$post['id_pembayaran'].'&status=error&message=Metode Pembayaran, Status tidak boleh kosong.');
        exit;
    }
}