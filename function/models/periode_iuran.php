<?php



function get()
{
    global $koneksi;
    $items = $koneksi->query("SELECT * FROM periode_iuran pi INNER JOIN jenis_iuran ji ON pi.id_jenis_iuran=ji.id_jenis_iuran");
    $data = [];
    while ($row = $items->fetch_assoc()) {
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
    $nominal = htmlspecialchars($post['nominal']);
    $insert = $koneksi->query("INSERT INTO `periode_iuran` (`id_periode_iuran`, `id_jenis_iuran`, `bulan`, `tahun`,`nominal`) VALUES (NULL, '$id_jenis_iuran', '$bulan', '$tahun',$nominal)");
    if ($insert) {
        $insertId = $koneksi->insert_id;
    } else {
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
    $nominal = htmlspecialchars($post['nominal']);
    $id_jenis_iuran = htmlspecialchars($post['id_jenis_iuran']);
    $update = $koneksi->query("UPDATE `periode_iuran` SET `bulan` = '$bulan', `tahun` = '$tahun',`nominal` = '$nominal', `id_jenis_iuran` = '$id_jenis_iuran' WHERE `periode_iuran`.`id_periode_iuran` = $id_periode_iuran");

    if ($update) {
        return true;
    } else {
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
    while ($row = $items->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}


function validasiTambah($post)
{
    if (!$post['bulan'] || !$post['id_jenis_iuran'] || !$post['tahun'] || !$post['nominal']) {
        redirectUrl(BASE_URL . '/main.php?page=periode-iuran-create&status=error&message=Jenis Iuran, Bulan, Tahun dan Nominal tidak boleh kosong.');
        exit;
    }
}

function validasiEdit($post)
{
    if (!$post['bulan'] || !$post['id_jenis_iuran'] || !$post['tahun'] || !$post['nominal']) {
        redirectUrl(BASE_URL . '/main.php?page=periode-iuran-edit&id_periode_iuran=' . $post['id_periode_iuran'] . '&status=error&message=Jenis Iuran, Bulan, Tahun dan Nominal tidak boleh kosong.');
        exit;
    }
}


function createPembayaranByAllUserByPeriodeIuran($id_periode_iuran)
{
    global $koneksi;
    $data_warga = getWarga();
    $periode_iuran = getById($id_periode_iuran);
    foreach ($data_warga as $warga) {
        $kode_pembayaran = time() . $warga['id_warga'];
        // cek apakah warga dengan id_periode_iuran sudah ada
        if (cekPembayaranWargaByPeriodeIuran($id_periode_iuran, $warga['id_warga']) == false) {
            // create pembayaran berdasarkan id_periode iuran dan warga
            $koneksi->query("INSERT INTO `pembayaran` (`id_pembayaran`, `kode_pembayaran`, `id_warga`, `id_periode_iuran`, `id_metode_pembayaran`, `nominal`, `status`, `tanggal`) VALUES (NULL, '$kode_pembayaran', $warga[id_warga], $id_periode_iuran, NULL, $periode_iuran[nominal], 'Belum Bayar', CURRENT_TIMESTAMP)");
        }
    }

    // ubah is_schedule jadi 1
    $updateSchedule = $koneksi->query("UPDATE `periode_iuran` SET `is_schedule` = 1 WHERE `periode_iuran`.`id_periode_iuran` = $id_periode_iuran");

    if($updateSchedule)
    {
        return true;
    }else{
        return false;
    }
}

function cekPembayaranWargaByPeriodeIuran($id_periode_iuran, $id_warga)
{
    global $koneksi;
    $item = $koneksi->query("SELECT * FROM pembayaran WHERE id_periode_iuran=$id_periode_iuran AND id_warga=$id_warga")->fetch_assoc();

    if ($item) {
        return true;
    } else {
        return false;
    }
}

function getKodePembayaranBaru()
{
    return time();
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
